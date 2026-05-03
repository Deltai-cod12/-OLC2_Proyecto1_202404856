grammar GolampiArm;

/* ---- Reglas sintacticas ---- */

program
: functionDecl* EOF
;

/* ---- Funciones ---- */

functionDecl
: FUNC IDENTIFIER LPAREN params? RPAREN returnTypes? block
;

params
: param (COMMA param)*
;

param
: IDENTIFIER type
;

returnTypes
: type
| LPAREN type (COMMA type)* RPAREN
;

/* ---- Bloques ---- */

block
: LBRACE statement* RBRACE
;

statement
: statementCore SEMICOLON?
;

statementCore
: functionCall
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
;

/* ---- Variables ---- */

varDecl
: VAR idList type (ASSIGN expList)?
| VAR IDENTIFIER arrayType (ASSIGN arrayLiteral)?
;

constDecl
: CONST IDENTIFIER type ASSIGN expression
;

shortVarDecl
: idList SHORT_ASSIGN expList
;

/* ---- Asignaciones ---- */

assignment
: assignTarget assignOp expList
;

assignTarget
: idList
| arrayAccess
| pointerAccess
;

assignOp
: ASSIGN
| PLUS_ASSIGN
| MINUS_ASSIGN
| MULT_ASSIGN
| DIV_ASSIGN
;

idList
: IDENTIFIER (COMMA IDENTIFIER)*
;

expList
: expression (COMMA expression)*
;

/* ---- Tipos ---- */

type
: baseType
| arrayType
| pointerType
;

baseType
: INT_TYPE
| FLOAT_TYPE
| BOOL_TYPE
| STRING_TYPE
| RUNE_TYPE
;

pointerType
: MULT type
;

arrayType
: arrayDimension+ baseType
;

arrayDimension
: LBRACK INT_LITERAL RBRACK
;

/* ---- Literales de arreglos ---- */

arrayLiteral
: arrayType LBRACE arrayElements? RBRACE
;

arrayElements
: arrayElement (COMMA arrayElement)* COMMA?
;

arrayElement
: expression
| LBRACE arrayElements? RBRACE
;

/* ---- Accesos ---- */

arrayAccess
: IDENTIFIER arrayIndex+
;

arrayIndex
: LBRACK expression RBRACK
;

pointerAccess
: MULT+ IDENTIFIER
;

/* ---- Llamadas a funciones (incluye built-ins) ---- */

functionCall
: functionName LPAREN args? RPAREN
;

functionName
: IDENTIFIER (DOT IDENTIFIER)?
;

args
: expList
;

/* ---- Expresiones ---- */

expression
: logicalOrExp
;

logicalOrExp
: logicalAndExp (OR logicalAndExp)*
;

logicalAndExp
: equalityExp (AND equalityExp)*
;

equalityExp
: relationalExp ((EQUAL | NOT_EQUAL) relationalExp)*
;

relationalExp
: additiveExp ((LESS | LESS_EQUAL | GREATER | GREATER_EQUAL) additiveExp)*
;

additiveExp
: multiplicativeExp ((PLUS | MINUS) multiplicativeExp)*
;

multiplicativeExp
: unaryExp ((MULT | DIV | MOD) unaryExp)*
;

unaryExp
: NOT unaryExp
| MINUS unaryExp
| MULT unaryExp
| AMP unaryExp
| primary
;

primary
: functionCall
| arrayAccess
| pointerAccess
| arrayLiteral
| INT_LITERAL
| FLOAT_LITERAL
| STRING
| RUNE_LITERAL
| TRUE
| FALSE
| NIL
| IDENTIFIER
| LPAREN expression RPAREN
;

/* ---- Control de flujo: IF ---- */

ifStmt
: IF (simpleStmt SEMICOLON)? expression block (ELSE (ifStmt | block))?
;

/* ---- SWITCH ---- */

switchStmt
: SWITCH expression LBRACE caseClause* defaultClause? RBRACE
;

caseClause
: CASE expList COLON statement*
;

defaultClause
: DEFAULT COLON statement*
;

/* ---- FOR ---- */

forStmt
: FOR forClause block
| FOR expression block
| FOR block
;

forClause
: simpleStmt SEMICOLON expression SEMICOLON simpleStmt
;

/* ---- Simple statements ---- */

simpleStmt
: shortVarDeclNoSemi
| assignmentNoSemi
| incDecStmt
;

incDecStmt
: IDENTIFIER (INC | DEC)
;

shortVarDeclNoSemi
: idList SHORT_ASSIGN expList
;

assignmentNoSemi
: assignTarget assignOp expList
;

/* ---- Transferencia ---- */

breakStmt
: BREAK
;

continueStmt
: CONTINUE
;

returnStmt
: RETURN expList?
;

/* ---- Palabras reservadas ---- */

FUNC   : 'func';
VAR    : 'var';
CONST  : 'const';
NIL    : 'nil';

IF       : 'if';
ELSE     : 'else';
SWITCH   : 'switch';
CASE     : 'case';
DEFAULT  : 'default';
FOR      : 'for';
BREAK    : 'break';
CONTINUE : 'continue';
RETURN   : 'return';

INT_TYPE    : 'int' ('32')?;
FLOAT_TYPE  : 'float' ('32')?;
BOOL_TYPE   : 'bool';
STRING_TYPE : 'string';
RUNE_TYPE   : 'rune';

TRUE  : 'true';
FALSE : 'false';

/* ---- Símbolos ---- */

LPAREN : '(';
RPAREN : ')';
LBRACE : '{';
RBRACE : '}';
LBRACK : '[';
RBRACK : ']';
SEMICOLON : ';';
COMMA : ',';
COLON : ':';
DOT : '.';

EQUAL : '==';
NOT_EQUAL : '!=';
LESS_EQUAL : '<=';
GREATER_EQUAL : '>=';
LESS : '<';
GREATER : '>';

ASSIGN : '=';
SHORT_ASSIGN : ':=';

PLUS_ASSIGN : '+=';
MINUS_ASSIGN : '-=';
MULT_ASSIGN : '*=';
DIV_ASSIGN : '/=';
INC : '++';
DEC : '--';

AND : '&&';
OR : '||';
NOT : '!';

PLUS : '+';
MINUS : '-';
MULT : '*';
DIV : '/';
MOD : '%';

AMP : '&';

/* ---- Literales ---- */
STRING : '"' (~["\r\n])* '"';
FLOAT_LITERAL : [0-9]+ '.' [0-9]+;
INT_LITERAL : [0-9]+;
RUNE_LITERAL : '\'' ( ~['\r\n\\] | '\\u' [0-9a-fA-F]{4} ) '\'';

/* ---- Identificadores ---- */
IDENTIFIER : [a-zA-Z_] [a-zA-Z0-9_]*;

/* ---- Comentarios ---- */
LINE_COMMENT : '//' ~[\r\n]* -> skip;
BLOCK_COMMENT : '/*' .*? '*/' -> skip;

/* ---- Espacios ---- */
WS : [ \t\r\n]+ -> skip;

/* ---- Token de error (cualquier carácter no reconocido) ---- */
ERROR_CHAR : . ;