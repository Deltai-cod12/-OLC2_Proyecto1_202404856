<?php

use Antlr\Antlr4\Runtime\Error\Listeners\ANTLRErrorListener;
use Antlr\Antlr4\Runtime\Recognizer;
use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;

/**
 * GolampiErrorListener
 * Captura errores léxicos y sintácticos de ANTLR
 * y los registra en el ErrorReport sin detener la ejecución.
 */
class GolampiErrorListener implements ANTLRErrorListener {

    private $errorReport;

    public function __construct($errorReport) {
        $this->errorReport = $errorReport;
    }

    public function syntaxError(
        Recognizer $recognizer,
        ?object $offendingSymbol,
        int $line,
        int $charPositionInLine,
        string $msg,
        ?RecognitionException $exception
    ): void {
        $tipo = ($recognizer instanceof \generated\GolampiLexer)
            ? "Léxico"
            : "Sintáctico";

        $this->errorReport->add($tipo, $msg, $line, $charPositionInLine);
    }

    public function reportAmbiguity(
        \Antlr\Antlr4\Runtime\Parser $recognizer,
        \Antlr\Antlr4\Runtime\Dfa\DFA $dfa,
        int $startIndex,
        int $stopIndex,
        bool $exact,
        ?\Antlr\Antlr4\Runtime\Utils\BitSet $ambigAlts,
        \Antlr\Antlr4\Runtime\Atn\ATNConfigSet $configs
    ): void {}

    public function reportAttemptingFullContext(
        \Antlr\Antlr4\Runtime\Parser $recognizer,
        \Antlr\Antlr4\Runtime\Dfa\DFA $dfa,
        int $startIndex,
        int $stopIndex,
        ?\Antlr\Antlr4\Runtime\Utils\BitSet $conflictingAlts,
        \Antlr\Antlr4\Runtime\Atn\ATNConfigSet $configs
    ): void {}

    public function reportContextSensitivity(
        \Antlr\Antlr4\Runtime\Parser $recognizer,
        \Antlr\Antlr4\Runtime\Dfa\DFA $dfa,
        int $startIndex,
        int $stopIndex,
        int $prediction,
        \Antlr\Antlr4\Runtime\Atn\ATNConfigSet $configs
    ): void {}
}