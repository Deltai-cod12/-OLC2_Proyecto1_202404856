<?php

header("Content-Type: application/json");

// Mostrar errores de PHP en la terminal
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ======================
// CARGAS
// ======================

// Composer (ANTLR runtime)
require_once __DIR__ . '/../vendor/autoload.php';

// ANTLR generado
require_once __DIR__ . '/../generated/GolampiLexer.php';
require_once __DIR__ . '/../generated/GolampiParser.php';
require_once __DIR__ . '/../generated/GolampiVisitor.php';
require_once __DIR__ . '/../generated/GolampiBaseVisitor.php';

// Interpreter
require_once __DIR__ . '/interpreter/Interpreter.php';
require_once __DIR__ . '/interpreter/Enviroment.php';
require_once __DIR__ . '/interpreter/Symbol.php';
require_once __DIR__ . '/interpreter/SymbolTable.php';

// Reports
require_once __DIR__ . '/reports/ErrorReport.php';
require_once __DIR__ . '/reports/SymbolTableReport.php';

use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\CommonTokenStream;
use generated\GolampiLexer;
use generated\GolampiParser;

// ======================
// LEER INPUT
// ======================

$input = file_get_contents("php://input");
$data = json_decode($input, true);
$codigo = $data["codigo"] ?? "";

// ======================
// ERROR REPORT (Singleton)
// ======================

$errorReport = ErrorReport::getInstance();
$errorReport->clear();

// Log del código recibido
error_log("=== EJECUTANDO CÓDIGO ===");
error_log($codigo);

// ======================
// ANTLR PARSER
// ======================

$inputStream = InputStream::fromString($codigo);
$lexer = new GolampiLexer($inputStream);
$tokenStream = new CommonTokenStream($lexer);
$parser = new GolampiParser($tokenStream);

// Regla inicial
$tree = $parser->program();

// ======================
// EJECUCIÓN
// ======================

$environment = new Environment();
$interpreter = new Interpreter($environment, $errorReport);

$interpreter->visit($tree);

// ======================
// ERRORES → TERMINAL
// ======================

$errors = $errorReport->getErrors();

if (!empty($errors)) {
    error_log("=== ERRORES DETECTADOS ===");
    foreach ($errors as $err) {
        error_log(
            "[" . $err["type"] . "] " .
            $err["message"] .
            " (L:" . $err["line"] .
            " C:" . $err["column"] . ")"
        );
    }
}

// ======================
// RESPUESTA AL FRONTEND
// ======================

echo json_encode([
    "salida" => $interpreter->getOutput(),
    "errores" => $errors,   // ← ahora es arreglo estructurado
    "simbolos" => $environment->getAll()
]);
