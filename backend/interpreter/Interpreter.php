<?php

use generated\GolampiBaseVisitor;

class Interpreter extends GolampiBaseVisitor {

    private $env;
    private $output = "";
    private $errorReport;

    public function __construct($environment, $errorReport) {
        $this->env = $environment;
        $this->errorReport = $errorReport;
    }

    public function getOutput() {
        return $this->output;
    }

    private function println($text) {
        $this->output .= $text . "\n";
    }

    private function semanticError($message) {
        $this->errorReport->add($message);
    }

    // =============================
    // BLOQUES (Scope léxico)
    // =============================

    public function visitBlock($ctx) {

        $previous = $this->env;
        $this->env = new Environment($previous);

        $this->visitChildren($ctx);

        $this->env = $previous;

        return null;
    }

    // =============================
    // PRINT
    // =============================

    public function visitPrintStmt($ctx) {
        if ($ctx->STRING()) {
            $text = trim($ctx->STRING()->getText(), '"');
            $this->println($text);
        }
        return null;
    }

    // fmt.Println(...)
    public function visitFunctionCall($ctx) {

        $name = $ctx->functionName()->getText();

        if ($name === "fmt.Println") {

            $values = [];

            if ($ctx->args()) {
                $expList = $ctx->args()->expList();

                foreach ($expList->expression() as $exp) {
                    $values[] = $this->visit($exp);
                }
            }

            $this->println(implode(" ", $values));
        }

        return null;
    }

    // =============================
    // VARIABLES
    // =============================

    // var x int = 10
    public function visitVarDecl($ctx) {

        $ids = $ctx->idList()->IDENTIFIER();
        $values = [];

        if ($ctx->expList()) {
            foreach ($ctx->expList()->expression() as $exp) {
                $values[] = $this->visit($exp);
            }
        }

        for ($i = 0; $i < count($ids); $i++) {
            $name = $ids[$i]->getText();
            $value = $values[$i] ?? null;

            try {
                $this->env->define($name, $value);
            } catch (Exception $e) {
                $this->semanticError($e->getMessage());
            }
        }

        return null;
    }

    // x := 10
    public function visitShortVarDecl($ctx) {

        $ids = $ctx->idList()->IDENTIFIER();
        $values = [];

        foreach ($ctx->expList()->expression() as $exp) {
            $values[] = $this->visit($exp);
        }

        for ($i = 0; $i < count($ids); $i++) {
            try {
                $this->env->define($ids[$i]->getText(), $values[$i]);
            } catch (Exception $e) {
                $this->semanticError($e->getMessage());
            }
        }

        return null;
    }

    // x = 20
    public function visitAssignment($ctx) {

        $ids = $ctx->idList()->IDENTIFIER();
        $values = [];

        foreach ($ctx->expList()->expression() as $exp) {
            $values[] = $this->visit($exp);
        }

        for ($i = 0; $i < count($ids); $i++) {
            try {
                $this->env->assign($ids[$i]->getText(), $values[$i]);
            } catch (Exception $e) {
                $this->semanticError($e->getMessage());
            }
        }

        return null;
    }

    // =============================
    // EXPRESIONES
    // =============================

    public function visitPrimary($ctx) {

        // Número
        if ($ctx->INT_LITERAL()) {
            return intval($ctx->INT_LITERAL()->getText());
        }

        // String
        if ($ctx->STRING()) {
            return trim($ctx->STRING()->getText(), '"');
        }

        // Variable
        if ($ctx->IDENTIFIER()) {
            $name = $ctx->IDENTIFIER()->getText();

            try {
                return $this->env->get($name);
            } catch (Exception $e) {
                error_log("Capturado en Interpreter: " . $e->getMessage());
                $this->errorReport->add($e->getMessage());
                return null;
            }

        }

        return $this->visitChildren($ctx);
    }
}
