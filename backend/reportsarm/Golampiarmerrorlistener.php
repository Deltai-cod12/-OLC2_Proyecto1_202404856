<?php

namespace reportsarm;

use Antlr\Antlr4\Runtime\Error\Listeners\ANTLRErrorListener;
use Antlr\Antlr4\Runtime\Recognizer;
use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
use Antlr\Antlr4\Runtime\Lexer;


/**
 * GolampiArmErrorListener
 *
 * Listener de errores ANTLR4 para el compilador Golampi → ARM64.
 *
 * CLASIFICACIÓN:
 *   - Si el reconocedor es una instancia de Lexer  → tipo "Léxico"
 *   - Si no (es un Parser)                         → tipo "Sintáctico"
 *
 * Esto evita que todos los errores aparezcan como "Sintáctico" en el frontend.
 */
class GolampiArmErrorListener implements ANTLRErrorListener
{
    private ErrorReport $errorReport;

    public function __construct(ErrorReport $errorReport)
    {
        $this->errorReport = $errorReport;
    }

    /**
     * @param Recognizer    $recognizer   El lexer o parser que detectó el error
     * @param mixed|null    $offendingSymbol  El token/carácter problemático (null en lexer)
     * @param int           $line         Línea del error
     * @param int           $charPosition Columna del error
     * @param string        $msg          Mensaje de error de ANTLR
     * @param RecognitionException|null $e Excepción original (puede ser null)
     */
    public function syntaxError(
        Recognizer $recognizer,
        $offendingSymbol,
        int $line,
        int $charPosition,
        string $msg,
        ?RecognitionException $e
    ): void {
        // Determinar si el error viene del Lexer o del Parser
        $type = ($recognizer instanceof Lexer) ? 'Léxico' : 'Sintáctico';

        // Limpiar el mensaje de ANTLR para hacerlo más legible
        $cleanMsg = $this->cleanMessage($msg, $type);

        $this->errorReport->addError($type, $cleanMsg, $line, $charPosition + 1);
    }

    public function scanTokensForLexerErrors(Lexer $lexer, array $tokens): void
    {
        foreach ($tokens as $token) {
            if ($token === null) continue;
            $type = $token->getType();
            if ($type === -1 || $type === 0) {
                $text = $token->getText() ?? '?';
                $line = $token->getLine();
                $col  = $token->getCharPositionInLine() + 1;
                if ($text !== '<EOF>') {
                    $this->errorReport->addError('Léxico', "Símbolo no reconocido: '{$text}'", $line, $col);
                }
            }
        }
    }
 
    public function scanSourceForInvalidChars(string $source): void
    {
        $lines          = explode("\n", $source);
        $inString       = false;
        $inLineComment  = false;
        $inBlockComment = false;
        $strChar        = '';
 
        foreach ($lines as $lineNum => $lineText) {
            $inLineComment = false;
            $len = strlen($lineText);
            for ($i = 0; $i < $len; $i++) {
                $ch   = $lineText[$i];
                $next = ($i + 1 < $len) ? $lineText[$i + 1] : '';
 
                if ($inBlockComment) {
                    if ($ch === '*' && $next === '/') { $inBlockComment = false; $i++; }
                    continue;
                }
                if ($inLineComment) continue;
 
                if ($inString) {
                    if ($ch === '\\') { $i++; continue; }
                    if ($ch === $strChar) $inString = false;
                    continue;
                }
 
                if ($ch === '/' && $next === '/') { $inLineComment = true; $i++; continue; }
                if ($ch === '/' && $next === '*') { $inBlockComment = true; $i++; continue; }
                if ($ch === '"' || $ch === '\'') { $inString = true; $strChar = $ch; continue; }
 
                $ord = ord($ch);
                if ($ord < 0x20 && $ord !== 0x09 && $ord !== 0x0A && $ord !== 0x0D) {
                    $this->errorReport->addError(
                        'Léxico',
                        "Carácter de control no permitido (0x" . strtoupper(dechex($ord)) . ")",
                        $lineNum + 1,
                        $i + 1
                    );
                }
            }
        }
    }






    public function reportAmbiguity(
        \Antlr\Antlr4\Runtime\Parser $recognizer,
        \Antlr\Antlr4\Runtime\Dfa\DFA $dfa,
        int $startIndex,
        int $stopIndex,
        bool $exact,
        ?\Antlr\Antlr4\Runtime\Utils\BitSet $ambigAlts,
        \Antlr\Antlr4\Runtime\Atn\ATNConfigSet $configs
    ): void {
        // Puedes ignorarlo o loguearlo si quieres
    }

    public function reportAttemptingFullContext(
        \Antlr\Antlr4\Runtime\Parser $recognizer,
        \Antlr\Antlr4\Runtime\Dfa\DFA $dfa,
        int $startIndex,
        int $stopIndex,
        ?\Antlr\Antlr4\Runtime\Utils\BitSet $conflictingAlts,
        \Antlr\Antlr4\Runtime\Atn\ATNConfigSet $configs
    ): void {
        // Opcional: logging
    }

    public function reportContextSensitivity(
        \Antlr\Antlr4\Runtime\Parser $recognizer,
        \Antlr\Antlr4\Runtime\Dfa\DFA $dfa,
        int $startIndex,
        int $stopIndex,
        int $prediction,
        \Antlr\Antlr4\Runtime\Atn\ATNConfigSet $configs
    ): void {
        // Opcional: logging
    }

    /**
     * Traduce y limpia los mensajes de error de ANTLR a español legible.
     */
    private function cleanMessage(string $msg, string $type): string
    {
        // Mensajes léxicos comunes
        if ($type === 'Léxico') {
            if (preg_match("/token recognition error at: '(.+)'/", $msg, $m)) {
                return "Carácter no reconocido: '{$m[1]}'";
            }
            if (str_contains($msg, 'unterminated string')) {
                return 'Cadena de texto no cerrada';
            }
            if (str_contains($msg, 'unterminated character')) {
                return 'Literal de carácter no cerrado';
            }
            return "Error léxico: {$msg}";
        }

        // Mensajes sintácticos comunes
        if (preg_match("/mismatched input '(.+)' expecting (.+)/", $msg, $m)) {
            $found    = $m[1];
            $expected = $this->cleanExpected($m[2]);
            if ($found === '<EOF>') {
                return "Fin de archivo inesperado. Se esperaba: {$expected}";
            }
            return "Token inesperado '{$found}'. Se esperaba: {$expected}";
        }

        if (preg_match("/extraneous input '(.+)' expecting (.+)/", $msg, $m)) {
            $found    = $m[1];
            $expected = $this->cleanExpected($m[2]);
            return "Token extra '{$found}'. Se esperaba: {$expected}";
        }

        if (preg_match("/missing (.+) at '(.+)'/", $msg, $m)) {
            $missing = $this->cleanExpected($m[1]);
            $at      = $m[2];
            return "Falta '{$missing}' antes de '{$at}'";
        }

        if (preg_match("/no viable alternative at input '(.+)'/", $msg, $m)) {
            return "Construcción sintáctica no válida cerca de '{$m[1]}'";
        }

        if (str_contains($msg, 'no viable alternative')) {
            return 'Construcción sintáctica no válida en este punto';
        }

        return "Error sintáctico: {$msg}";
    }

    /**
     * Simplifica la lista de tokens esperados que ANTLR genera.
     */
    private function cleanExpected(string $expected): string
    {
        // Quitar llaves y comillas extras de ANTLR
        $expected = trim($expected, '{} ');
        $expected = str_replace(["'", '"'], '', $expected);

        // Reemplazar nombres de token por palabras más legibles
        $map = [
            'IDENTIFIER' => 'identificador',
            'INT_LITERAL'   => 'número entero',
            'FLOAT_LITERAL' => 'número decimal',
            'STRING'        => 'cadena de texto',
            'RUNE_LITERAL'  => 'carácter',
            'SEMICOLON'     => "';'",
            'LBRACE'        => "'{'",
            'RBRACE'        => "'}'",
            'LPAREN'        => "'('",
            'RPAREN'        => "')'",
            'LBRACKET'      => "'['",
            'RBRACKET'      => "']'",
            'COMMA'         => "','",
            'EOF'           => 'fin de archivo',
        ];

        foreach ($map as $token => $readable) {
            $expected = str_replace($token, $readable, $expected);
        }

        // Si la lista es muy larga, truncarla
        if (strlen($expected) > 80) {
            $parts = explode(',', $expected);
            $expected = implode(', ', array_slice($parts, 0, 4)) . '...';
        }

        return $expected;
    }
}