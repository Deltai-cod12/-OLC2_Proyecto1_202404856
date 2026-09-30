# Golampi Programming Language | Lenguaje de programación Golampi

**Repository name suggestion:** `golampi-interpreter`  
**Description:** Go-inspired programming language with an ANTLR4 grammar, PHP interpreter, semantic checks and symbol/error reports.

## English

### Overview

Golampi is a Go-inspired language project. ANTLR4 defines the grammar and generates the lexer and parser; a PHP backend performs semantic analysis and interprets the parsed program. A browser interface sends source code to the backend and displays execution output, tokens and diagnostics.

### Language and implementation features

- Functions with parameters and one or more return values
- Variables, constants, short declarations and scoped blocks
- Primitive values: `int`, `float`, `bool`, `string` and `rune`
- Fixed-size and multidimensional arrays, array literals and indexed access
- Pointer types, address-of and dereference operations
- Arithmetic, comparison, logical and compound assignment operators
- `if` / `else`, `switch`, `for`, `break`, `continue` and `return`
- Lexer and parser diagnostics, semantic errors, and symbol table output
- Built-in calls including `fmt.Println`

### Technology

- ANTLR4 grammar (`antlr/Golampi.g4`) and generated PHP lexer/parser
- PHP interpreter and semantic analyzer
- ANTLR4 PHP runtime installed through Composer
- HTML, CSS and JavaScript frontend
- Composer dependency metadata (`composer.json` and `composer.lock`)

### Requirements

- PHP CLI with the extensions required by the ANTLR4 PHP runtime
- Composer

### Run locally

From the repository root:

```bash
composer install
php -S 127.0.0.1:8000 -t .
```

Open `http://127.0.0.1:8000/frontend/`. The frontend sends code to `backend/Execute.php` relative to its own URL. Use the browser editor to submit a Golampi program and inspect its output, tokens and errors.

### Documentation

- [Technical manual](https://github.com/Deltai-cod12/-OLC2_Proyecto1_202404856/blob/master/Manual%20Tecnico%20-%20Golampi_202404856.md)
- [Repository and user manual](https://github.com/Deltai-cod12/-OLC2_Proyecto1_202404856/tree/master)

### Academic context

Developed as a compiler construction project for Universidad de San Carlos de Guatemala.

## Español

### Descripción

Golampi es un lenguaje inspirado en Go. ANTLR4 define la gramática y genera el lexer y el parser; un backend en PHP realiza el análisis semántico e interpreta el programa. Una interfaz web envía el código fuente al backend y muestra la salida, los tokens y los diagnósticos.

### Características del lenguaje e implementación

- Funciones con parámetros y uno o varios valores de retorno
- Variables, constantes, declaraciones cortas y bloques con ámbito
- Tipos primitivos: `int`, `float`, `bool`, `string` y `rune`
- Arreglos de tamaño fijo y multidimensionales, literales y acceso por índice
- Tipos de puntero, operador de dirección y desreferenciación
- Operadores aritméticos, relacionales, lógicos y de asignación compuesta
- `if` / `else`, `switch`, `for`, `break`, `continue` y `return`
- Diagnósticos léxicos y sintácticos, errores semánticos y tabla de símbolos
- Llamadas integradas como `fmt.Println`

### Tecnologías

- Gramática ANTLR4 (`antlr/Golampi.g4`) y lexer/parser PHP generados
- Intérprete y analizador semántico en PHP
- Runtime PHP de ANTLR4 instalado con Composer
- Interfaz en HTML, CSS y JavaScript
- Dependencias Composer (`composer.json` y `composer.lock`)

### Requisitos

- PHP CLI con las extensiones necesarias para el runtime PHP de ANTLR4
- Composer

### Ejecución local

Desde la raíz del repositorio:

```bash
composer install
php -S 127.0.0.1:8000 -t .
```

Abre `http://127.0.0.1:8000/frontend/`. La interfaz envía el código a `backend/Execute.php` usando una ruta relativa. Escribe un programa Golampi en el editor y revisa la salida, los tokens y los errores.

### Documentación

- [Manual técnico](https://github.com/Deltai-cod12/-OLC2_Proyecto1_202404856/blob/master/Manual%20Tecnico%20-%20Golampi_202404856.md)
- [Repositorio y manual de usuario](https://github.com/Deltai-cod12/-OLC2_Proyecto1_202404856/tree/master)

### Contexto académico

Desarrollado como proyecto de construcción de compiladores en la Universidad de San Carlos de Guatemala.

---

**Topics:** `antlr4`, `compiler`, `interpreter`, `programming-language`, `php`, `grammar`, `semantic-analysis`, `symbol-table`, `golang-inspired`
