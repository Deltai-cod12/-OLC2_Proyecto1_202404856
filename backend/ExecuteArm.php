<?php
/**
 * ExecuteArm.php
 * Punto de entrada del compilador Golampi → ARM64.
 * Recibe código fuente Golampi por POST y devuelve JSON con:
 *   - assembly   : string  (código ARM64 generado)
 *   - errors     : array   (tabla de errores)
 *   - symbols    : array   (tabla de símbolos)
 *   - success    : bool
 *   - message    : string
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// ── Autoload ──────────────────────────────────────────────────────────────────
require_once __DIR__ . '/../vendor/autoload.php';

// ── ANTLR  ───────────────────────────────
require_once __DIR__ . '/../generated_arm/GolampiArmLexer.php';
require_once __DIR__ . '/../generated_arm/GolampiArmParser.php';
require_once __DIR__ . '/../generated_arm/GolampiArmVisitor.php';
require_once __DIR__ . '/../generated_arm/GolampiArmBaseVisitor.php';

// ── CÓDIGO ───────────────────────────
require_once __DIR__ . '/reportsarm/ErrorReport.php';
require_once __DIR__ . '/reportsarm/GolampiArmErrorListener.php';
require_once __DIR__ . '/reportsarm/SymbolTableReport.php';
require_once __DIR__ . '/interpreterarm/ArmSymbolTable.php';
require_once __DIR__ . '/interpreterarm/ArmCodeGenerator.php';

use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\InputStream;

use generated_arm\GolampiArmLexer;
use generated_arm\GolampiArmParser;

use reportsarm\ErrorReport;
use reportsarm\GolampiArmErrorListener;
use reportsarm\SymbolTableReport;

use interpreterarm\ArmCodeGenerator;

// ── Leer código fuente ────────────────────────────────────────────────────────
$input = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = file_get_contents('php://input');
    $data = json_decode($body, true);
    if (isset($data['code'])) {
        $input = $data['code'];
    } elseif (isset($_POST['code'])) {
        $input = $_POST['code'];
    }
}

if (trim($input) === '') {
    echo json_encode([
        'success'  => false,
        'message'  => 'No se recibió código fuente.',
        'assembly' => '',
        'errors'   => [],
        'symbols'  => [],
    ]);
    exit;
}

// ── Inicializar reportes ──────────────────────────────────────────────────────
$errorReport = new ErrorReport();
$symReport   = new SymbolTableReport();

try {
    // ── Análisis léxico ───────────────────────────────────────────────────────
    $stream = InputStream::fromString($input);    
    $lexer  = new GolampiArmLexer($stream);
    $lexer->removeErrorListeners();
    $lexer->addErrorListener(new GolampiArmErrorListener($errorReport));

    // ── Análisis sintáctico ───────────────────────────────────────────────────
    $tokens = new CommonTokenStream($lexer);
    $parser = new GolampiArmParser($tokens);
    $parser->removeErrorListeners();
    $parser->addErrorListener(new GolampiArmErrorListener($errorReport));

    $tree = $parser->program();

    // Si hay errores léxicos/sintácticos graves, no generar código
    if ($errorReport->hasErrors() && hasBlockingErrors($errorReport->getErrors())) {
        echo json_encode([
            'success'  => false,
            'message'  => 'Se encontraron errores léxicos/sintácticos. No se generó código ARM64.',
            'assembly' => '',
            'errors'   => $errorReport->toArray(),
            'symbols'  => $symReport->toArray(),
        ]);
        exit;
    }

    // ── Generación de código ARM64 ────────────────────────────────────────────
    $generator = new ArmCodeGenerator($errorReport, $symReport);
    $generator->visitProgram($tree);

    $assembly = $generator->getAssembly();

    echo json_encode([
        'success'  => !$errorReport->hasErrors(),
        'message'  => $errorReport->hasErrors()
            ? 'Compilación completada con advertencias semánticas.'
            : 'Compilación exitosa. Código ARM64 generado.',
        'assembly' => $assembly,
        'errors'   => $errorReport->toArray(),
        'symbols'  => $symReport->toArray(),
    ]);

} catch (\Throwable $e) {
    $errorReport->addError('Interno', $e->getMessage(), 0, 0);
    echo json_encode([
        'success'  => false,
        'message'  => 'Error interno del compilador: ' . $e->getMessage(),
        'assembly' => '',
        'errors'   => $errorReport->toArray(),
        'symbols'  => $symReport->toArray(),
    ]);
}

/**
 * Determina si los errores bloquean la generación de código.
 * Los errores léxicos/sintácticos son bloqueantes; los semánticos no.
 */
function hasBlockingErrors(array $errors): bool
{
    foreach ($errors as $err) {
        if (in_array($err['type'], ['Léxico', 'Sintáctico'])) {
            return true;
        }
    }
    return false;
}