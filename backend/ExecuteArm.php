<?php
/**
 * ExecuteArm.php
 * Punto de entrada del compilador Golampi → ARM64.
 *
 * POLÍTICA DE ERRORES:
 *   Los errores NUNCA detienen la generación de código.
 *   Léxico, Sintáctico y Semántico se acumulan en la tabla de errores
 *   y la compilación continúa siempre.
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../generated_arm/GolampiArmLexer.php';
require_once __DIR__ . '/../generated_arm/GolampiArmParser.php';
require_once __DIR__ . '/../generated_arm/GolampiArmVisitor.php';
require_once __DIR__ . '/../generated_arm/GolampiArmBaseVisitor.php';
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
    if (isset($data['code']))       $input = $data['code'];
    elseif (isset($_POST['code']))  $input = $_POST['code'];
}

if (trim($input) === '') {
    echo json_encode(['success' => false, 'message' => 'No se recibió código fuente.',
                      'assembly' => '', 'errors' => [], 'symbols' => []]);
    exit;
}

$errorReport = new ErrorReport();
$symReport   = new SymbolTableReport();
$assembly    = '';

try {
    // ── Escaneo previo de caracteres inválidos (errores léxicos silenciados) ──
    $errorListener = new GolampiArmErrorListener($errorReport);
    $errorListener->scanSourceForInvalidChars($input);

    // ── Análisis léxico ───────────────────────────────────────────────────────
    $stream = InputStream::fromString($input);
    $lexer  = new GolampiArmLexer($stream);
    $lexer->removeErrorListeners();
    $lexer->addErrorListener($errorListener);

    // ── Análisis sintáctico ───────────────────────────────────────────────────
    $tokens = new CommonTokenStream($lexer);
    $parser = new GolampiArmParser($tokens);
    $parser->removeErrorListeners();
    $parser->addErrorListener($errorListener);

    // Parsear SIEMPRE — errores se acumulan sin detener la compilación
    $tree = $parser->program();

    // Escanear tokens de error que ANTLR pudo haber silenciado
    try {
        $tokens->fill(); // MUY IMPORTANTE: asegura que todos los tokens estén cargados

        $allTokens = $tokens->getTokens(
            0,
            $tokens->size() - 1
        );        
        if (is_array($allTokens)) {
            $errorListener->scanTokensForLexerErrors($lexer, $allTokens);
        }
    } catch (\Throwable $ignored) {
        // Si el runtime no soporta getTokens(), ignorar silenciosamente
    }

    // ── Generación de código ARM64 ────────────────────────────────────────────
    $generator = new ArmCodeGenerator($errorReport, $symReport);
    $generator->visitProgram($tree);
    $assembly = $generator->getAssembly();

} catch (\Throwable $e) {
    $errorReport->addError('Semántico', 'Error interno: ' . $e->getMessage(), 0, 0);
}

$hasErrors = $errorReport->hasErrors();
echo json_encode([
    'success'  => !$hasErrors,
    'message'  => $hasErrors
        ? 'Compilación completada con ' . count($errorReport->getErrors()) . ' error(es).'
        : 'Compilación exitosa. Código ARM64 generado.',
    'assembly' => $assembly,
    'errors'   => $errorReport->toArray(),
    'symbols'  => $symReport->toArray(),
]);