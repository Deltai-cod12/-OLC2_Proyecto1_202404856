<?php
header("Content-Type: application/json");

// Suprimir output de warnings PHP — no deben contaminar el JSON
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

// Convertir warnings en logs de terminal (no en output)
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    error_log("[PHP Warning $errno] $errstr en $errfile:$errline");
    return true;
});

// Capturar excepciones no atrapadas y retornar JSON válido
set_exception_handler(function($e) {
    error_log("[Fatal] " . $e->getMessage() . " en " . $e->getFile() . ":" . $e->getLine());
    echo json_encode([
        "salida"   => "",
        "errores"  => "[Fatal] " . $e->getMessage(),
        "simbolos" => [],
        "tokens"   => []
    ]);
    exit;
});

// CARGAS
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../generated/GolampiLexer.php';
require_once __DIR__ . '/../generated/GolampiParser.php';
require_once __DIR__ . '/../generated/GolampiVisitor.php';
require_once __DIR__ . '/../generated/GolampiBaseVisitor.php';

require_once __DIR__ . '/interpreter/Interpreter.php';
require_once __DIR__ . '/interpreter/Enviroment.php';
require_once __DIR__ . '/interpreter/Symbol.php';
require_once __DIR__ . '/interpreter/SymbolTable.php';
require_once __DIR__ . '/interpreter/Pointervalue.php';

require_once __DIR__ . '/reports/ErrorReport.php';
require_once __DIR__ . '/reports/SymbolTableReport.php';
require_once __DIR__ . '/reports/GolampiErrorListener.php';

use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\CommonTokenStream;
use generated\GolampiLexer;
use generated\GolampiParser;

// LEER INPUT
$input  = file_get_contents("php://input");
$data   = json_decode($input, true);
$codigo = $data["codigo"] ?? "";

// Limpiar reportes
ErrorReport::getInstance()->clear();
SymbolTable::getInstance()->clear();

// TOKENS + ERRORES LÉXICOS
$inputStreamTokens = InputStream::fromString($codigo);
$lexerTokens       = new GolampiLexer($inputStreamTokens);
$lexerTokens->removeErrorListeners();
$lexerTokens->addErrorListener(new GolampiErrorListener(ErrorReport::getInstance()));

$vocab     = $lexerTokens->getVocabulary();
$tokens    = $lexerTokens->getAllTokens();
$tokenList = [];

foreach ($tokens as $token) {
    $type = $token->getType();
    $text = $token->getText();
    $name = $vocab->getSymbolicName($type);
    if ($name === null) $name = $vocab->getLiteralName($type);
    $tokenList[] = [
        "tipo"    => $name,
        "lexema"  => $text,
        "linea"   => $token->getLine(),
        "columna" => $token->getCharPositionInLine()
    ];
}

error_log("=== EJECUTANDO CÓDIGO ===");
error_log($codigo);

// PARSER — errores sintácticos capturados sin detener ejecución
$inputStream = InputStream::fromString($codigo);
$lexer       = new GolampiLexer($inputStream);
$lexer->removeErrorListeners();
$lexer->addErrorListener(new GolampiErrorListener(ErrorReport::getInstance()));

$tokenStream = new CommonTokenStream($lexer);
$parser      = new GolampiParser($tokenStream);
$parser->removeErrorListeners();
$parser->addErrorListener(new GolampiErrorListener(ErrorReport::getInstance()));

$tree = $parser->program();

// EJECUCIÓN — continúa aunque haya errores semánticos
$salida      = "";
$environment = new Environment();
$interpreter = new Interpreter($environment, ErrorReport::getInstance());

try {
    $interpreter->visit($tree);
} catch (Throwable $e) {
    error_log("[Error interno] " . $e->getMessage());
    ErrorReport::getInstance()->add("Interno", $e->getMessage(), $e->getLine(), 0);
}

$salida = $interpreter->getOutput();

// FORMATEAR ERRORES
$errorsRaw = ErrorReport::getInstance()->getErrors();
$errors    = [];

foreach ($errorsRaw as $err) {
    $errors[] =
        "[" . $err["type"]      . "] " .
        $err["message"]         .
        " (L:" . $err["line"]   .
        " C:"  . $err["column"] . ")";
}

if (!empty($errorsRaw)) {
    error_log("=== ERRORES DETECTADOS ===");
    foreach ($errorsRaw as $err) {
        error_log("[" . $err["type"] . "] " . $err["message"] .
            " (L:" . $err["line"] . " C:" . $err["column"] . ")");
    }
}

// RESPUESTA
echo json_encode([
    "salida"        => $salida,
    "errores"       => implode("\n", $errors),   // string para mostrar en consola
    "erroresTabla"  => $errorsRaw,                 // array para descargar como tabla
    "simbolos"      => SymbolTable::getInstance()->toArray(),
    "tokens"        => $tokenList
]);