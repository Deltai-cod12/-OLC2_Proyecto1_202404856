# Manual Técnico — Golampi Compiler (ARM64)
**Organización de Lenguajes y Compiladores 2**
**Universidad San Carlos de Guatemala — FIUSAC**

---

## Índice

1. [Descripción General](#1-descripción-general)
2. [Arquitectura del Sistema](#2-arquitectura-del-sistema)
3. [Gramática Formal de Golampi](#3-gramática-formal-de-golampi)
4. [Diagrama de Clases](#4-diagrama-de-clases)
5. [Flujo de Procesamiento](#5-flujo-de-procesamiento)
6. [Tabla de Símbolos — Diseño y Flujo](#6-tabla-de-símbolos--diseño-y-flujo)
7. [Generación de Código ARM64](#7-generación-de-código-arm64)
8. [Runtime Embebido](#8-runtime-embebido)
9. [Manejo de Errores](#9-manejo-de-errores)
10. [Estructura de Archivos](#10-estructura-de-archivos)

---

## 1. Descripción General

El **Golampi Compiler** es un compilador completo para el lenguaje académico **Golampi**, inspirado en la sintaxis de Go (Golang). Traduce código fuente Golampi a **código ensamblador ARM64 (AArch64)**, el cual puede ensamblarse con `aarch64-linux-gnu-as`, enlazarse y ejecutarse mediante **QEMU** en modo usuario.

### Tecnologías utilizadas

| Componente | Tecnología |
|---|---|
| Análisis léxico y sintáctico | ANTLRv4 (PHP runtime) |
| Backend del compilador | PHP 8.x |
| Frontend (GUI) | HTML5 + CSS3 + JavaScript puro |
| Arquitectura objetivo | AArch64 (ARM64) |
| Emulación | QEMU (`qemu-aarch64`) |
| Servidor web | Apache / PHP built-in server |

---

## 2. Arquitectura del Sistema

El sistema sigue una arquitectura **monolítica cliente/servidor** con separación lógica clara entre capas:

```
┌────────────────────────────────────────────────────────────┐
│                   NAVEGADOR WEB (Cliente)                  │
│  ┌─────────────────────┐   ┌──────────────────────────┐   │
│  │   Editor de código   │   │   Panel de reportes      │   │
│  │   (textarea)         │   │   (errores / símbolos)   │   │
│  └──────────┬──────────┘   └──────────────────────────┘   │
│             │  HTTP POST (código fuente JSON)               │
└─────────────┼──────────────────────────────────────────────┘
              │
              ▼
┌────────────────────────────────────────────────────────────┐
│                   SERVIDOR PHP (Backend)                   │
│                                                            │
│   ExecuteArm.php                                           │
│        │                                                   │
│        ▼                                                   │
│   ┌──────────────┐   ┌───────────────┐                    │
│   │ GolampiArm   │   │ GolampiArm    │  ← ANTLR4 genera   │
│   │ Lexer.php    │──▶│ Parser.php    │    automáticamente  │
│   └──────────────┘   └───────┬───────┘                    │
│                               │  AST (árbol sintáctico)    │
│                               ▼                            │
│                      ┌────────────────┐                    │
│                      │ ArmCodeGenerator│  ← Visitor        │
│                      │ (Visitor ANTLR4)│                   │
│                      └────────┬───────┘                    │
│                  ┌────────────┼────────────┐               │
│                  ▼            ▼            ▼               │
│           ArmSymbolTable  ErrorReport  SymbolTableReport   │
│                  │                                         │
│                  ▼                                         │
│           Código ARM64 (.s)                                │
└────────────────────────────────────────────────────────────┘
              │
              ▼
┌────────────────────────────────────────────────────────────┐
│              ENTORNO DE EJECUCIÓN (QEMU)                   │
│   aarch64-linux-gnu-as → aarch64-linux-gnu-ld → qemu-aarch64 │
└────────────────────────────────────────────────────────────┘
```

### Fases del compilador

```
Código fuente Golampi
        │
        ▼  Fase 1
  [Análisis Léxico]  ←── GolampiArmLexer (ANTLR4)
        │                 Tokens: IDENTIFIER, INT_LITERAL, etc.
        ▼  Fase 2
  [Análisis Sintáctico] ←── GolampiArmParser (ANTLR4)
        │                    Árbol sintáctico concreto (CST)
        ▼  Fase 3
  [Análisis Semántico]  ←── ArmCodeGenerator (Visitor)
        │                    Construcción de tabla de símbolos
        │                    Verificación de tipos
        ▼  Fase 4
  [Generación ARM64]    ←── ArmCodeGenerator (mismo Visitor)
        │                    Código ensamblador AArch64
        ▼
  archivo.s  →  as  →  ld  →  qemu-aarch64  →  Salida
```

---

## 3. Gramática Formal de Golampi

### 3.1 Reglas de producción (EBNF)

```ebnf
program       ::= functionDecl* EOF

functionDecl  ::= 'func' IDENTIFIER '(' params? ')' returnTypes? block

params        ::= param (',' param)*
param         ::= IDENTIFIER type

returnTypes   ::= type
                | '(' type (',' type)* ')'

block         ::= '{' statement* '}'

statement     ::= statementCore ';'?

statementCore ::= functionCall
                | varDecl
                | constDecl
                | shortVarDecl
                | assignment
                | incDecStmt
                | ifStmt
                | switchStmt
                | forStmt
                | breakStmt
                | continueStmt
                | returnStmt
                | expression
```

### 3.2 Declaraciones

```ebnf
varDecl       ::= 'var' idList type ('=' expList)?
                | 'var' IDENTIFIER arrayType ('=' arrayLiteral)?

constDecl     ::= 'const' IDENTIFIER type '=' expression

shortVarDecl  ::= idList ':=' expList

assignment    ::= assignTarget assignOp expList

assignTarget  ::= idList | arrayAccess | pointerAccess

assignOp      ::= '=' | '+=' | '-=' | '*=' | '/='

idList        ::= IDENTIFIER (',' IDENTIFIER)*
expList       ::= expression (',' expression)*
```

### 3.3 Tipos

```ebnf
type          ::= baseType | arrayType | pointerType

baseType      ::= 'int32' | 'int' | 'float32' | 'float'
                | 'bool' | 'string' | 'rune'

pointerType   ::= '*' type

arrayType     ::= arrayDimension+ baseType
arrayDimension::= '[' INT_LITERAL ']'
```

### 3.4 Expresiones (jerarquía de precedencia)

```ebnf
expression      ::= logicalOrExp

logicalOrExp    ::= logicalAndExp ('||' logicalAndExp)*

logicalAndExp   ::= equalityExp ('&&' equalityExp)*

equalityExp     ::= relationalExp (('==' | '!=') relationalExp)*

relationalExp   ::= additiveExp (('<' | '<=' | '>' | '>=') additiveExp)*

additiveExp     ::= multiplicativeExp (('+' | '-') multiplicativeExp)*

multiplicativeExp ::= unaryExp (('*' | '/' | '%') unaryExp)*

unaryExp        ::= '!' unaryExp
                  | '-' unaryExp
                  | '*' unaryExp          /* desreferencia */
                  | '&' unaryExp          /* dirección */
                  | primary

primary         ::= functionCall
                  | arrayAccess
                  | pointerAccess
                  | arrayLiteral
                  | INT_LITERAL
                  | FLOAT_LITERAL
                  | STRING
                  | RUNE_LITERAL
                  | 'true' | 'false' | 'nil'
                  | IDENTIFIER
                  | '(' expression ')'
```

### 3.5 Sentencias de control

```ebnf
ifStmt        ::= 'if' (simpleStmt ';')? expression block
                  ('else' (ifStmt | block))?

switchStmt    ::= 'switch' expression '{' caseClause* defaultClause? '}'
caseClause    ::= 'case' expList ':' statement*
defaultClause ::= 'default' ':' statement*

forStmt       ::= 'for' forClause block
                | 'for' expression block
                | 'for' block

forClause     ::= simpleStmt ';' expression ';' simpleStmt

breakStmt     ::= 'break'
continueStmt  ::= 'continue'
returnStmt    ::= 'return' expList?
```

### 3.6 Tokens léxicos

```ebnf
IDENTIFIER    ::= [a-zA-Z_][a-zA-Z0-9_]*
INT_LITERAL   ::= [0-9]+
FLOAT_LITERAL ::= [0-9]+ '.' [0-9]+
STRING        ::= '"' (~["\r\n])* '"'
RUNE_LITERAL  ::= '\'' (~['\r\n\\] | '\\u' [0-9a-fA-F]{4}) '\''

LINE_COMMENT  ::= '//' ~[\r\n]*         → skip
BLOCK_COMMENT ::= '/*' .*? '*/'         → skip
WS            ::= [ \t\r\n]+            → skip
```

### 3.7 Palabras reservadas

```
func    var     const   nil     if      else    switch
case    default for     break   continue return  true
false   int32   int     float32 float   bool    string  rune
```

---

## 4. Diagrama de Clases

```
┌───────────────────────────────────────────────────────────────────┐
│  Namespace: interpreterarm                                        │
│                                                                   │
│  ┌─────────────────────────────────┐                             │
│  │         ArmSymbol               │                             │
│  ├─────────────────────────────────┤                             │
│  │ + name       : string           │                             │
│  │ + type       : string           │                             │
│  │ + scope      : string           │                             │
│  │ + offset     : int              │                             │
│  │ + size       : int              │                             │
│  │ + line       : int              │                             │
│  │ + column     : int              │                             │
│  │ + isConst    : bool             │                             │
│  │ + isParam    : bool             │                             │
│  │ + value      : string           │                             │
│  │ + dimensions : array            │                             │
│  │ + baseType   : string           │                             │
│  │ + paramTypes : array            │                             │
│  │ + returnTypes: array            │                             │
│  └─────────────────────────────────┘                             │
│                    ▲ usa                                          │
│                    │                                              │
│  ┌─────────────────────────────────┐                             │
│  │        ArmSymbolTable           │                             │
│  ├─────────────────────────────────┤                             │
│  │ - globalScope    : array        │                             │
│  │ - functionScopes : array        │                             │
│  │ - currentFunction: string       │                             │
│  │ - currentOffset  : int          │                             │
│  │ - frameSizes     : array        │                             │
│  ├─────────────────────────────────┤                             │
│  │ + enterFunction(name): void     │                             │
│  │ + exitFunction(): void          │                             │
│  │ + declareLocal(...): ArmSymbol  │                             │
│  │ + declareGlobal(...): ArmSymbol │                             │
│  │ + declareFunction(...): ArmSymbol│                            │
│  │ + lookup(name): ?ArmSymbol      │                             │
│  │ + existsInCurrentScope(): bool  │                             │
│  │ + getFrameSize(fn): int         │                             │
│  │ + reserveSpace(bytes): int      │                             │
│  │ + getAllSymbols(): array         │                             │
│  │ + normalizeType(t): string  {s} │                             │
│  │ + sizeOf(t): int            {s} │                             │
│  └─────────────────────────────────┘                             │
│                    ▲ contiene                                     │
│                    │                                              │
│  ┌──────────────────────────────────────────────────────────┐    │
│  │                  ArmCodeGenerator                        │    │
│  │     extends AbstractParseTreeVisitor                     │    │
│  │     implements GolampiArmVisitor                         │    │
│  ├──────────────────────────────────────────────────────────┤    │
│  │ - symTable       : ArmSymbolTable                        │    │
│  │ - errorReport    : ErrorReport                           │    │
│  │ - symReport      : SymbolTableReport                     │    │
│  │ - dataSection    : array                                 │    │
│  │ - textSection    : array                                 │    │
│  │ - currentCode    : array                                 │    │
│  │ - currentFunc    : string                                │    │
│  │ - labelCount     : int                                   │    │
│  │ - strCount       : int                                   │    │
│  │ - scratchOffset  : int  (-8, primer slot del frame)      │    │
│  │ - breakStack     : array                                 │    │
│  │ - continueStack  : array                                 │    │
│  │ - funcSignatures : array                                 │    │
│  ├──────────────────────────────────────────────────────────┤    │
│  │ + getAssembly(): string                                  │    │
│  │ + visitProgram(ctx): mixed                               │    │
│  │ + visitFunctionDecl(ctx): mixed                          │    │
│  │ + visitBlock(ctx): mixed                                 │    │
│  │ + visitStatement(ctx): mixed                             │    │
│  │ + visitVarDecl(ctx): mixed                               │    │
│  │ + visitConstDecl(ctx): mixed                             │    │
│  │ + visitShortVarDecl(ctx): mixed                          │    │
│  │ + visitAssignment(ctx): mixed                            │    │
│  │ + visitIncDecStmt(ctx): mixed                            │    │
│  │ + visitIfStmt(ctx): mixed                                │    │
│  │ + visitSwitchStmt(ctx): mixed                            │    │
│  │ + visitForStmt(ctx): mixed                               │    │
│  │ + visitReturnStmt(ctx): mixed                            │    │
│  │ - emitPrintln(args): void                                │    │
│  │ - evalExpr(ctx, dest): string                            │    │
│  │ - evalOr/And/Eq/Rel/Add/Mul/Unary/Primary(): string      │    │
│  │ - arrayAddrToReg(ctx, reg): void                         │    │
│  │ - inferType(ctx): string                                 │    │
│  │ - resolveType(ctx): string                               │    │
│  │ - buildRuntime(): array                                  │    │
│  │ - movImm(reg, val): void                                 │    │
│  │ - load(reg, sym): void                                   │    │
│  │ - store(reg, sym): void                                  │    │
│  │ - e(line): void                                          │    │
│  │ - lbl(label): void                                       │    │
│  │ - newLabel(prefix): string                               │    │
│  └──────────────────────────────────────────────────────────┘    │
└───────────────────────────────────────────────────────────────────┘

┌──────────────────────┐     ┌───────────────────────┐
│  Namespace: reportsarm│     │  Namespace: reportsarm │
│  ErrorReport          │     │  SymbolTableReport     │
├──────────────────────┤     ├───────────────────────┤
│ - errors: array       │     │ - symbols: array       │
├──────────────────────┤     ├───────────────────────┤
│ + addError(...)       │     │ + addSymbol(...)       │
│ + getErrors(): array  │     │ + getSymbols(): array  │
│ + hasErrors(): bool   │     │ + toHTML(): string     │
│ + toHTML(): string    │     │ + toArray(): array     │
│ + toArray(): array    │     └───────────────────────┘
└──────────────────────┘
```

---

## 5. Flujo de Procesamiento

### 5.1 Flujo general del compilador

```
ENTRADA: código fuente Golampi (string)
         │
         ▼
┌─────────────────────────────────────────────────────────┐
│  ExecuteArm.php                                         │
│                                                         │
│  1. Leer código fuente del POST body (JSON)             │
│  2. Crear InputStream(código)                           │
│  3. Instanciar GolampiArmLexer                          │
│     → Registrar GolampiArmErrorListener                 │
│  4. Crear CommonTokenStream                             │
│  5. Instanciar GolampiArmParser                         │
│     → Registrar GolampiArmErrorListener                 │
│  6. Llamar parser.program() → CST (árbol)               │
│  7. Si hay errores léxicos/sintácticos: retornar JSON   │
│  8. Instanciar ArmCodeGenerator                         │
│  9. generator.visitProgram(árbol)                       │
│  10. Obtener assembly = generator.getAssembly()         │
│  11. Retornar JSON {assembly, errors, symbols, success} │
└─────────────────────────────────────────────────────────┘
         │
         ▼
SALIDA: JSON con código ARM64, errores y tabla de símbolos
```

### 5.2 Flujo del Visitor (ArmCodeGenerator)

```
visitProgram(ctx)
    │
    ├── PASE 1: Registrar firmas de funciones (hoisting)
    │   └── Para cada functionDecl:
    │       └── registerSig() → declareFunction() en tabla global
    │
    └── PASE 2: Generar código para cada función
        └── visitFunctionDecl(ctx)
            │
            ├── symTable.enterFunction(name)
            ├── Reservar scratch slot: reserveSpace(8) → offset -8
            ├── Emitir etiqueta: name:
            ├── Emitir prólogo: stp x29,x30,[sp,#-FRAME]!; mov x29,sp
            ├── Procesar parámetros → declareLocal() + str xN,[x29,#offset]
            ├── visitBlock(body)
            │   └── Para cada statement:
            │       └── visitStatementCore()
            │           ├── visitVarDecl()     → evalExpr() + store()
            │           ├── visitShortVarDecl() → inferType() + evalExpr() + store()
            │           ├── visitAssignment()  → evalExpr() + applyAssignOp()
            │           ├── visitIfStmt()      → evalExpr() + branches
            │           ├── visitForStmt()     → labels + evalExpr() + branches
            │           ├── visitSwitchStmt()  → case labels + comparisons
            │           ├── visitReturnStmt()  → evalExpr() → x0 + b _ret_name
            │           └── callFuncStmt()     → emitPrintln() o bl funcName
            │
            ├── Emitir etiqueta: _ret_name:
            ├── Emitir epílogo: ldp x29,x30,[sp],#FRAME; ret
            ├── symTable.exitFunction() → calcular frameSize
            └── Reemplazar placeholder __FRAME_name__ con tamaño real
```

### 5.3 Flujo de evalExpr

```
evalExpr(ExpressionContext, dest)
    └── evalOr()
        └── evalAnd()
            └── evalEq()
                └── evalRel()
                    └── evalAdd()
                        └── evalMul()
                            └── evalUnary()
                                └── evalPrimary()
                                    ├── INT_LITERAL   → movImm(dest, val)
                                    ├── FLOAT_LITERAL → movImm(dest, val*1000)
                                    ├── STRING        → adrp/add data label
                                    ├── RUNE_LITERAL  → movImm(dest, codepoint)
                                    ├── true/false    → mov dest, #1/#0
                                    ├── nil           → mov dest, #0
                                    ├── IDENTIFIER    → load(dest, sym)
                                    ├── functionCall  → callFuncExpr()
                                    ├── arrayAccess   → arrayAddrToReg() + ldr
                                    └── '(' expr ')'  → evalExpr()
```

### 5.4 Flujo de emitPrintln (problema resuelto)

```
emitPrintln([arg1, arg2, ..., argN])
    │
    │  sc = scratchOffset = -8  (slot fijo en frame, NO mueve sp)
    │
    ├── Para idx=0 (primer arg):
    │   ├── inferType(arg) → type
    │   ├── evalExpr(arg, 'x9') → resultado en x9
    │   ├── str x9, [x29, #sc]    ← guardar en scratch ANTES de cualquier bl
    │   │   (NO usa push/pop que movería sp y corrompería offsets)
    │   ├── [NO print_space para el primer arg]
    │   ├── ldr x0, [x29, #sc]    ← recargar desde scratch → x0
    │   └── bl print_XXX_inline   ← versión sin newline
    │
    ├── Para idx=1..N-2 (args intermedios):
    │   ├── evalExpr(arg, 'x9')
    │   ├── str x9, [x29, #sc]    ← scratch seguro
    │   ├── bl print_space         ← destruye x0-x8, pero scratch en frame ✓
    │   ├── ldr x0, [x29, #sc]    ← recargar
    │   └── bl print_XXX_inline
    │
    └── Para idx=N-1 (último arg):
        ├── evalExpr(arg, 'x9')
        ├── str x9, [x29, #sc]
        ├── bl print_space
        ├── ldr x0, [x29, #sc]
        └── bl print_XXX           ← versión CON newline
```

---

## 6. Tabla de Símbolos — Diseño y Flujo

### 6.1 Estructura de la tabla

La tabla de símbolos (`ArmSymbolTable`) maneja dos niveles de ámbito:

```
┌─────────────────────────────────────────────────────┐
│  globalScope: { nombre → ArmSymbol }                │
│  ┌──────────────────────────────────────────────┐   │
│  │  main     → { type: function, offset: 0 }    │   │
│  │  suma     → { type: function, offset: 0 }    │   │
│  │  PI       → { type: float32,  offset: -32 }  │   │
│  └──────────────────────────────────────────────┘   │
│                                                     │
│  functionScopes: { función → { nombre → ArmSymbol }}│
│  ┌──────────────────────────────────────────────┐   │
│  │  "main":                                     │   │
│  │    _scratch → { offset: -8,  size: 8 }       │   │
│  │    varInt   → { offset: -16, size: 8 }       │   │
│  │    varFloat → { offset: -24, size: 8 }       │   │
│  │    varBool  → { offset: -32, size: 8 }       │   │
│  │    ...                                       │   │
│  │  "suma":                                     │   │
│  │    _scratch → { offset: -8,  size: 8 }       │   │
│  │    a        → { offset: -16, size: 8, param }│   │
│  │    b        → { offset: -24, size: 8, param }│   │
│  └──────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────┘
```

### 6.2 Layout del stack frame ARM64

```
   sp (antes del prólogo)
   │
   ▼
   ┌────────────────────┐  ← sp después de stp x29,x30,[sp,#-FRAME]!
   │  x30 (link reg)    │  [sp + 8]
   ├────────────────────┤
   │  x29 (frame ptr)   │  [sp + 0]  ← x29 apunta aquí
   ├────────────────────┤
   │  scratch slot      │  [x29 - 8]   (emitPrintln usa este slot)
   ├────────────────────┤
   │  variable 1        │  [x29 - 16]
   ├────────────────────┤
   │  variable 2        │  [x29 - 24]
   ├────────────────────┤
   │       ...          │
   ├────────────────────┤
   │  variable N        │  [x29 - (N+1)*8]
   └────────────────────┘
```

### 6.3 Flujo de construcción de la tabla

```
1. registerSig(functionDecl)
   └── symTable.declareFunction(name, paramTypes, returnTypes, line, col)
       └── Añade a globalScope

2. visitFunctionDecl(functionDecl)
   ├── symTable.enterFunction(name)
   │   ├── currentFunction = name
   │   └── currentOffset = 0
   │
   ├── symTable.reserveSpace(8)
   │   └── currentOffset -= 8  → -8 (scratch slot)
   │
   ├── Para cada parámetro:
   │   └── symTable.declareLocal(name, type, size=8, ...)
   │       ├── currentOffset -= 8
   │       └── ArmSymbol { offset: currentOffset, ... }
   │
   ├── visitBlock() → Para cada var/const/short:
   │   └── symTable.declareLocal(name, type, size, ...)
   │       └── ArmSymbol { offset: currentOffset, ... }
   │
   └── symTable.exitFunction()
       ├── size = -currentOffset + 16  (variables + x29/x30)
       ├── size = ceil(size / 16) * 16  (alinear a 16 bytes)
       └── frameSizes[name] = size
```

### 6.4 Reporte de tabla de símbolos

La tabla de símbolos generada contiene:

| Campo | Descripción |
|---|---|
| Identificador | Nombre de la variable/función |
| Tipo | `int32`, `float32`, `bool`, `string`, `rune`, `array[T]`, `función` |
| Ámbito | `global` o nombre de la función donde fue declarada |
| Valor | Valor inicial o `(init)`, `(default)`, `(const)`, `(param)` |
| Línea | Línea en el código fuente |
| Columna | Columna en el código fuente |

---

## 7. Generación de Código ARM64

### 7.1 Convención de registros

| Registro | Uso |
|---|---|
| `x0–x7` | Parámetros de función y valores de retorno |
| `x0` | Valor de retorno principal |
| `x1` | Segundo valor de retorno |
| `x8` | Número de syscall (exclusivo para `svc`) |
| `x9–x15` | Temporales de expresión (caller-saved) |
| `x19–x21` | Temporales preservados en runtime (callee-saved) |
| `x29` | Frame Pointer |
| `x30` | Link Register (dirección de retorno) |
| `sp` | Stack Pointer |

### 7.2 Representación de tipos en ARM64

| Tipo Golampi | Representación ARM64 | Tamaño |
|---|---|---|
| `int32` | Entero con signo en registro 64-bit | 8 bytes |
| `float32` | Entero escalado ×1000 (ej: 3.14 → 3140) | 8 bytes |
| `bool` | 0 = false, 1 = true | 8 bytes |
| `rune` | Codepoint Unicode (ASCII byte) | 8 bytes |
| `string` | Puntero a cadena terminada en `\0` | 8 bytes (ptr) |
| `*T` | Dirección de memoria | 8 bytes (ptr) |
| `[N]T` | N elementos contiguos en stack | N×8 bytes |

### 7.3 Ejemplo de traducción

**Golampi:**
```go
func suma(a int32, b int32) int32 {
    return a + b
}
```

**ARM64 generado:**
```asm
suma:
    stp  x29, x30, [sp, #-32]!
    mov  x29, sp
    str  x0, [x29, #-16]        // param a
    str  x1, [x29, #-24]        // param b
    ldr  x9, [x29, #-16]        // load a
    ldr  x10, [x29, #-24]       // load b
    add  x9, x9, x10            // a + b
    mov  x0, x9                 // return value
    b    _ret_suma
_ret_suma:
    ldp  x29, x30, [sp], #32
    ret
```

### 7.4 Manejo de valores inmediatos grandes

ARM64 solo acepta valores inmediatos de hasta 16 bits en `mov`. Para valores ≥ 65536 se usa `movz` + `movk`:

```asm
// Para valor = 1000000 (> 65535)
movz x9, #16960        // 0x4240 (bits 15:0)
movk x9, #15, lsl #16  // 0x000F (bits 31:16)
```

---

## 8. Runtime Embebido

El compilador genera automáticamente las siguientes subrutinas ARM64 en cada archivo `.s`:

| Función | Descripción |
|---|---|
| `print_int` | Imprime entero con newline (convierte a ASCII iterativamente) |
| `print_int_inline` | Imprime entero sin newline |
| `print_bool` | Imprime `true` o `false` con newline |
| `print_bool_inline` | Imprime `true` o `false` sin newline |
| `print_string` | Imprime cadena (strlen dinámico) con newline |
| `print_string_inline` | Imprime cadena sin newline |
| `print_rune` | Imprime un carácter ASCII con newline |
| `print_rune_inline` | Imprime un carácter ASCII sin newline |
| `print_float` | Imprime float (parte entera + punto + decimales sin trailing zeros) con newline |
| `print_float_inline` | Imprime float sin newline |
| `_pf_dec` | Subrutina auxiliar: imprime parte decimal sin ceros finales |
| `print_space` | Imprime un espacio |
| `print_newline` | Imprime solo newline |

Todas las funciones respetan la convención AArch64:
- Preservan `x19`, `x20`, `x21` (callee-saved)
- Usan `stp x29, x30, [sp, #-N]!` como prólogo
- Usan `ldp x29, x30, [sp], #N` como epílogo

---

## 9. Manejo de Errores

### 9.1 Errores léxicos

Detectados por `GolampiArmErrorListener` durante el tokenizado:
- Caracteres no reconocidos por la gramática

### 9.2 Errores sintácticos

Detectados por `GolampiArmErrorListener` durante el parsing:
- Construcciones incompletas
- Tokens inesperados

### 9.3 Errores semánticos

Detectados por `ArmCodeGenerator` durante el recorrido del AST:
- Variable no declarada en el ámbito actual
- Identificador ya declarado en el mismo ámbito
- Arreglo no declarado

### 9.4 Formato del reporte de errores

| Campo | Descripción |
|---|---|
| `#` | Número secuencial del error |
| `Tipo` | `Léxico`, `Sintáctico`, o `Semántico` |
| `Descripción` | Mensaje descriptivo del error |
| `Línea` | Línea del código fuente donde ocurrió |
| `Columna` | Columna del código fuente |

---

## 10. Estructura de Archivos

```
proyecto/
├── antlr/
│   └── GolampiArm.g4              ← Gramática ANTLR4
├── backend/
│   ├── ExecuteArm.php             ← Punto de entrada del compilador
│   ├── interpreterarm/
│   │   ├── ArmCodeGenerator.php   ← Generador de código ARM64 (Visitor)
│   │   └── ArmSymbolTable.php     ← Tabla de símbolos
│   └── reportsarm/
│       ├── ErrorReport.php        ← Reporte de errores
│       ├── GolampiArmErrorListener.php ← Listener ANTLR4
│       └── SymbolTableReport.php  ← Reporte de tabla de símbolos
├── frontend/
│   ├── index.html                 ← Interfaz gráfica
│   ├── style.css                  ← Estilos
│   └── script.js                  ← Lógica del frontend
├── generated_arm/                 ← Generado por ANTLR4 (NO editar)
│   ├── GolampiArmLexer.php
│   ├── GolampiArmParser.php
│   ├── GolampiArmVisitor.php
│   ├── GolampiArmBaseVisitor.php
│   └── Context/
│       └── *.php                  ← Contextos del CST
├── vendor/                        ← Dependencias Composer
│   └── antlr/antlr4-php-runtime/
└── composer.json
```

### Comando para compilar la gramática

```bash
cd antlr
antlr4 -Dlanguage=PHP -visitor -package generated_arm -o ../generated_arm GolampiArm.g4
```

### Comando para compilar y ejecutar un archivo ARM64

```bash
# Ensamblar
aarch64-linux-gnu-as -g -o programa.o programa.s

# Enlazar
aarch64-linux-gnu-ld -o programa_arm programa.o

# Ejecutar con QEMU
qemu-aarch64-static ./programa_arm
```

---

*Manual Técnico — Golampi Compiler ARM64 | Compiladores 2 — FIUSAC 2026*