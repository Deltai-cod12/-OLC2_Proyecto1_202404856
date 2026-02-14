<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../generated/GolampiLexer.php';
require_once __DIR__ . '/../generated/GolampiParser.php';

use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\CommonTokenStream;
use generated\GolampiLexer;
use generated\GolampiParser;

$code = '
/* ---- Programa completo de prueba Golampi ---- */

func suma(a int, b int) int {
    var resultado int = a + b
    return resultado
}

func operaciones(x int, y int) (int, int) {
    var suma int = x + y
    var resta int = x - y
    return suma, resta
}

func main() {

    // ---- Constantes y variables ----
    const PI float = 3.14
    var a int = 10
    var b int = 20
    c := 30
    d, e := 40, 50

    fmt.Println("Variables inicializadas:", a, b, c, d, e)

    // ---- Uso de punteros ----
    var p *int
    p = &a
    *p = 100
    fmt.Println("Valor de a usando puntero:", a)

    // ---- Arreglos ----
    var arr [3]int = [3]int{1, 2, 3}
    var matriz [2][2]int = [2][2]int{
        {1, 2},
        {3, 4},
    }

    arr[0] = 10
    matriz[1][0] = 30

    fmt.Println("Longitud del arreglo arr:", len(arr))

    // ---- Uso de len con string ----
    var saludo string = "Hola"
    fmt.Println("Longitud de la cadena:", len(saludo))

    // ---- Llamadas a funciones ----
    var r int = suma(a, b)
    s, t := operaciones(50, 20)

    fmt.Println("Resultados de funciones:", r, s, t)

    // ---- Uso de typeOf ----
    fmt.Println("Tipo de variable r:", typeOf(r))
    fmt.Println("Tipo de variable saludo:", typeOf(saludo))

    // ---- IF / ELSE IF / ELSE ----
    if a > b {
        fmt.Println("a es mayor")
    } else if a == b {
        fmt.Println("a y b son iguales")
    } else {
        fmt.Println("b es mayor")
    }

    // ---- SWITCH ----
    switch r {
        case 10:
            fmt.Println("Resultado es 10")
        case 30, 120:
            fmt.Println("Resultado esperado")
        default:
            fmt.Println("Otro resultado")
    }

    // ---- FOR tipo clásico ----
    for i := 0; i < 5; i++ {
        if i == 3 {
            continue
        }
        fmt.Println("Iteracion:", i)
    }

    // ---- FOR con condición ----
    var contador int = 0
    for contador < 3 {
        contador++
    }
    fmt.Println("Contador final:", contador)

    // ---- FOR infinito ----
    for {
        break
    }

    // ---- Expresiones complejas ----
    var x int = (a + b) * 2
    var y int = -x
    var z bool = (x > y) && true || false

    fmt.Println("Expresiones:", x, y, z)

    // ---- Asignaciones compuestas ----
    x += 10
    x -= 5
    x *= 2
    x /= 3

    fmt.Println("Resultado final de x:", x)

    // ---- Uso de substr ----
    var palabra string = "Compiladores"
    var sub string = substr(palabra, 0, 4)
    fmt.Println("Subcadena:", sub)

    // ---- Uso de now ----
    var fecha string = now()
    fmt.Println("Fecha actual:", fecha)

    // ---- Uso opcional de punto y coma ----
    a = 1;
    b = 2
    c := 3;
    d++

    fmt.Println("Fin del programa")
}

';

/* =========================
   TOKENS
   ========================= */

echo "===== TOKENS RECONOCIDOS =====\n";

$inputStream = InputStream::fromString($code);
$lexer = new GolampiLexer($inputStream);

$vocab = $lexer->getVocabulary();
$tokens = $lexer->getAllTokens();

foreach ($tokens as $token) {
    $type = $token->getType();
    $text = $token->getText();

    $name = $vocab->getSymbolicName($type);
    if ($name === null) {
        $name = $vocab->getLiteralName($type);
    }

    echo $name . " -> " . $text . PHP_EOL;
}

echo "===== FIN TOKENS =====\n";


/* =========================
   PARSER / ÁRBOL SINTÁCTICO
   ========================= */

echo "\n===== ÁRBOL SINTÁCTICO =====\n";

/* Importante: recrear el lexer porque getAllTokens() lo consume */
$inputStream = InputStream::fromString($code);
$lexer = new GolampiLexer($inputStream);

$tokenStream = new CommonTokenStream($lexer);
$parser = new GolampiParser($tokenStream);

/* Regla inicial de la gramática */
$tree = $parser->program();

/* Imprimir árbol en formato tipo LISP */
echo $tree->toStringTree($parser->getRuleNames()) . PHP_EOL;

echo "===== FIN ÁRBOL =====\n";
