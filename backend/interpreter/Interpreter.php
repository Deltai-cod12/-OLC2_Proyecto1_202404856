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

    private function semanticError($message, $ctx = null) {

        $line = 0;
        $column = 0;

        if ($ctx != null && $ctx->start != null) {
            $line = $ctx->start->getLine();
            $column = $ctx->start->getCharPositionInLine();
        }

        $this->errorReport->add("Semántico", $message, $line, $column);
    }


    // ==================================================
    // PROGRAMA
    // ==================================================
    public function visitProgram($ctx) {
        return $this->visitChildren($ctx);
    }

    // ==================================================
    // FUNCIONES
    // Ejecuta solo main
    // ==================================================
    public function visitFunctionDecl($ctx) {

        $name = $ctx->IDENTIFIER()->getText();

        // Ejecutar solo main
        if ($name === "main") {
            $this->visit($ctx->block());
        }

        return null;
    }

    // ==================================================
    // BLOQUES (scope léxico)
    // ==================================================
    public function visitBlock($ctx) {

        $previous = $this->env;
        $this->env = new Environment($previous);

        foreach ($ctx->statement() as $stmt) {
            $this->visit($stmt);
        }

        $this->env = $previous;
        return null;
    }

    // ==================================================
    // STATEMENT
    // ==================================================
    public function visitStatement($ctx) {
        return $this->visitChildren($ctx);
    }

    public function visitStatementCore($ctx) {
        return $this->visitChildren($ctx);
    }

    // ==================================================
    // PRINT
    // ==================================================
    public function visitFunctionCall($ctx) {

        $name = $ctx->functionName()->getText();

        if ($name === "fmt.Println") {

            $values = [];

            if ($ctx->args()) {
                foreach ($ctx->args()->expList()->expression() as $exp) {
                    $values[] = $this->visit($exp);
                }
            }

            $this->println(implode(" ", $values));
        }

        return null;
    }

    // ==================================================
    // VARIABLES
    // ==================================================

    // var x = 10
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

            $this->env->define($name, $value);
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
            $this->env->define($ids[$i]->getText(), $values[$i]);
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
                $this->semanticError($e->getMessage(), $ctx);
            }
        }

        return null;
    }

    // ==================================================
    // EXPRESIONES
    // ==================================================
    public function visitPrimary($ctx) {

        // Entero
        if ($ctx->INT_LITERAL()) {
            return intval($ctx->INT_LITERAL()->getText());
        }

        // String
        if ($ctx->STRING()) {
            return trim($ctx->STRING()->getText(), '"');
        }

        // true / false
        if ($ctx->TRUE()) return true;
        if ($ctx->FALSE()) return false;

        // Identificador
        if ($ctx->IDENTIFIER()) {
            $name = $ctx->IDENTIFIER()->getText();

            try {
                return $this->env->get($name);
            } catch (Exception $e) {
                    $this->semanticError($e->getMessage(), $ctx);
                return null;
            }
        }

        return $this->visitChildren($ctx);
    }
}
