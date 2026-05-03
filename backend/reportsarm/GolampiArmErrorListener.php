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
}