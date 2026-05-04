<?php

namespace reportsarm;

use Antlr\Antlr4\Runtime\Error\Listeners\BaseErrorListener;
use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
use Antlr\Antlr4\Runtime\Recognizer;

class GolampiArmErrorListener extends BaseErrorListener
{
    private ErrorReport $errorReport;

    public function __construct(ErrorReport $errorReport)
    {
        $this->errorReport = $errorReport;
    }

    public function syntaxError(
        Recognizer $recognizer,
        ?object $offendingSymbol,
        int $line,
        int $charPositionInLine,
        string $msg,
        ?RecognitionException $e
    ): void {
        // Distinguish lexer vs parser errors
        if ($offendingSymbol === null) {
            $this->errorReport->addError('Léxico', $msg, $line, $charPositionInLine);
        } else {
            $this->errorReport->addError('Sintáctico', $msg, $line, $charPositionInLine);
        }
    }

    public function scanSourceForInvalidChars(string $source): void
{
    $lines = explode("\n", $source);

    foreach ($lines as $lineNum => $lineText) {
        $len = strlen($lineText);

        for ($i = 0; $i < $len; $i++) {
            $ord = ord($lineText[$i]);

            if ($ord < 0x20 && $ord !== 0x09 && $ord !== 0x0A && $ord !== 0x0D) {
                $this->errorReport->addError(
                    'Léxico',
                    "Carácter inválido (0x" . strtoupper(dechex($ord)) . ")",
                    $lineNum + 1,
                    $i + 1
                );
            }
        }
    }
}

public function scanTokensForLexerErrors($lexer, array $tokens): void
{
    foreach ($tokens as $token) {
        if ($token === null) continue;

        $type = $token->getType();

        if ($type === -1 || $type === 0) {
            $this->errorReport->addError(
                'Léxico',
                "Símbolo no reconocido: " . $token->getText(),
                $token->getLine(),
                $token->getCharPositionInLine() + 1
            );
        }
    }
}
}