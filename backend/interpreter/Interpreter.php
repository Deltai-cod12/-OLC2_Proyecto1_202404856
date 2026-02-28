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

    // fmt.Println
    private function println($text) {

        if (is_bool($text)) {
            $text = $text ? "true" : "false";
        }

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

    // INFERENCIA DE TIPO
    private function inferType($value) {
        if (is_int($value)) return "int";
        if (is_float($value)) return "float";
        if (is_bool($value)) return "bool";
        if (is_string($value)) return (mb_strlen($value) === 1) ? "rune" : "string";
        if ($value === null) return "nil";
        return "int";
    }

    private function getTypeFromCtx($typeCtx) {
        if ($typeCtx == null) return null;
        $text = $typeCtx->getText();
        switch ($text) {
            case "int": case "int32": return "int";
            case "float": case "float32": return "float";
            case "bool": return "bool";
            case "string": return "string";
            case "rune": return "rune";
            default: return "int";
        }
    }

    // PROGRAMA
    public function visitProgram($ctx) {
        return $this->visitChildren($ctx);
    }

    // FUNCIONES
    // Ejecuta solo main
    public function visitFunctionDecl($ctx) {
        $name = $ctx->IDENTIFIER()->getText();
        if ($name === "main") {
            $this->visit($ctx->block());
        }
        return null;
    }

    // BLOQUES
    public function visitBlock($ctx) {
        $previous = $this->env;
        $this->env = new Environment($previous);
        foreach ($ctx->statement() as $stmt) {
            $this->visit($stmt);
        }
        $this->env = $previous;
        return null;
    }

    // STATEMENTS
    public function visitStatement($ctx) {
        return $this->visitChildren($ctx);
    }

    public function visitStatementCore($ctx) {
        return $this->visitChildren($ctx);
    }

    // FUNCIONES BUILT-IN
    public function visitFunctionCall($ctx) {

        $name = $ctx->functionName()->getText();

        if ($name === "fmt.Println") {

            $values = [];

            if ($ctx->args()) {
                foreach ($ctx->args()->expList()->expression() as $exp) {

                    $value = $this->visit($exp);

                    // Convertir correctamente
                    if (is_bool($value)) {
                        $value = $value ? "true" : "false";
                    }

                    $values[] = $value;
                }
            }

            $this->output .= implode(" ", $values) . "\n";
        }

        return null;
    }

    // VARIABLES
    public function visitVarDecl($ctx) {
        $ids = $ctx->idList()->IDENTIFIER();
        $dataType = $this->getTypeFromCtx($ctx->type());

        $values = [];
        if ($ctx->expList()) {
            foreach ($ctx->expList()->expression() as $exp) {
                $values[] = $exp; // guardar la expresión, no evaluarla aún
            }
        }

        //declarar variables con valor por defecto
        for ($i = 0; $i < count($ids); $i++) {
            $token = $ids[$i]->getSymbol();
            $name = $ids[$i]->getText();
            $line = $token->getLine();
            $column = $token->getCharPositionInLine();

            try {
                // definir sin valor → usa default del tipo
                $this->env->define($name, $dataType, null, $line, $column);
            } catch (Exception $e) {
                $this->semanticError($e->getMessage(), $ctx);
            }
        }

        //evaluar y asignar valores
        for ($i = 0; $i < count($values); $i++) {
            $name = $ids[$i]->getText();

            try {
                $value = $this->visit($values[$i]);
                $this->env->assign($name, $value);
            } catch (Exception $e) {
                $this->semanticError($e->getMessage(), $ctx);
            }
        }

        return null;
    }

    // :=
    public function visitShortVarDecl($ctx) {
        $ids = $ctx->idList()->IDENTIFIER();
        $values = [];
        foreach ($ctx->expList()->expression() as $exp) {
            $values[] = $this->visit($exp);
        }
        for ($i = 0; $i < count($ids); $i++) {
            $token = $ids[$i]->getSymbol();
            $name = $ids[$i]->getText();
            $value = $values[$i] ?? null;
            $line = $token->getLine();
            $column = $token->getCharPositionInLine();
            $dataType = $this->inferType($value);
            try {
                $this->env->define($name, $dataType, $value, $line, $column);
            } catch (Exception $e) {
                $this->semanticError($e->getMessage(), $ctx);
            }
        }
        return null;
    }

    // := en for
    public function visitShortVarDeclNoSemi($ctx) {

        $ids = $ctx->idList()->IDENTIFIER();
        $values = [];

        foreach ($ctx->expList()->expression() as $exp) {
            $values[] = $this->visit($exp);
        }

        for ($i = 0; $i < count($ids); $i++) {

            $token = $ids[$i]->getSymbol();
            $name = $ids[$i]->getText();
            $value = $values[$i] ?? null;

            $line = $token->getLine();
            $column = $token->getCharPositionInLine();

            $dataType = $this->inferType($value);

            try {
                $this->env->define($name, $dataType, $value, $line, $column);
            } catch (Exception $e) {
                $this->semanticError($e->getMessage(), $ctx);
            }
        }

        return null;
    }

    // ASIGNACIONES
    public function visitAssignment($ctx) {
        $op = $ctx->assignOp()->getText();
        $ids = $ctx->assignTarget()->idList()->IDENTIFIER();
        $values = [];
        foreach ($ctx->expList()->expression() as $exp) {
            $values[] = $this->visit($exp);
        }
        for ($i = 0; $i < count($ids); $i++) {
            $name = $ids[$i]->getText();
            $value = $values[$i] ?? null;
            try {
                $current = $this->env->get($name);
                switch ($op) {
                    case "=": $newValue = $value; break;
                    case "+=": $newValue = $this->safeAdd($current, $value); break;
                    case "-=": $newValue = $this->safeSub($current, $value); break;
                    case "*=": $newValue = $this->safeMul($current, $value); break;
                    case "/=": $newValue = $this->safeDiv($current, $value, $name); break;
                    default: $newValue = $value;
                }
                $this->env->assign($name, $newValue);
            } catch (Exception $e) {
                $this->semanticError($e->getMessage(), $ctx);
            }
        }
        return null;
    }

    // Asignacion en for
    public function visitAssignmentNoSemi($ctx) {

        $op = $ctx->assignOp()->getText();
        $ids = $ctx->assignTarget()->idList()->IDENTIFIER();

        $values = [];
        foreach ($ctx->expList()->expression() as $exp) {
            $values[] = $this->visit($exp);
        }

        for ($i = 0; $i < count($ids); $i++) {

            $name = $ids[$i]->getText();
            $value = $values[$i] ?? null;

            try {
                $current = $this->env->get($name);

                switch ($op) {
                    case "=":  $newValue = $value; break;
                    case "+=": $newValue = $this->safeAdd($current, $value); break;
                    case "-=": $newValue = $this->safeSub($current, $value); break;
                    case "*=": $newValue = $this->safeMul($current, $value); break;
                    case "/=": $newValue = $this->safeDiv($current, $value, ""); break;
                    default: $newValue = $value;
                }

                $this->env->assign($name, $newValue);

            } catch (Exception $e) {
                $this->semanticError($e->getMessage(), $ctx);
            }
        }

        return null;
    }

    // CONSTANTES
    public function visitConstDecl($ctx) {
        $token = $ctx->IDENTIFIER()->getSymbol();
        $name = $ctx->IDENTIFIER()->getText();
        $dataType = $this->getTypeFromCtx($ctx->type());
        $value = $this->visit($ctx->expression());
        $line = $token->getLine();
        $column = $token->getCharPositionInLine();
        try {
            $this->env->defineConst($name, $dataType, $value, $line, $column);
        } catch (Exception $e) {
            $this->semanticError($e->getMessage(), $ctx);
        }
        return null;
    }

    // EXPRESIONES ARITMÉTICAS Y LÓGICAS
    public function visitExpression($ctx) { return $this->visit($ctx->logicalOrExp()); }

    // Operador OR
    public function visitLogicalOrExp($ctx) {

        $result = $this->visit($ctx->logicalAndExp(0));

        if (count($ctx->logicalAndExp()) > 1) {

            if (!is_bool($result)) {
                $this->semanticError("Operador || requiere operandos bool", $ctx);
                return null;
            }

            for ($i = 1; $i < count($ctx->logicalAndExp()); $i++) {

                if ($result === true) {
                    return true;
                }

                $right = $this->visit($ctx->logicalAndExp($i));

                if (!is_bool($right)) {
                    $this->semanticError("Operador || requiere operandos bool", $ctx);
                    return null;
                }

                $result = $result || $right;
            }
        }

        return $result;
    }

    // Operacion AND
    public function visitLogicalAndExp($ctx) {

        $result = $this->visit($ctx->equalityExp(0));

        // ⚠ SOLO validar si realmente hay operador &&
        if (count($ctx->equalityExp()) > 1) {

            if (!is_bool($result)) {
                $this->semanticError("Operador && requiere operandos bool", $ctx);
                return null;
            }

            for ($i = 1; $i < count($ctx->equalityExp()); $i++) {

                // Cortocircuito
                if ($result === false) {
                    return false;
                }

                $right = $this->visit($ctx->equalityExp($i));

                if (!is_bool($right)) {
                    $this->semanticError("Operador && requiere operandos bool", $ctx);
                    return null;
                }

                $result = $result && $right;
            }
        }

        return $result;
    }

    // ==
    public function visitEqualityExp($ctx) {

        $left = $this->visit($ctx->relationalExp(0));

        for ($i = 1; $i < count($ctx->relationalExp()); $i++) {

            $op = $ctx->getChild(2*$i-1)->getText();
            $right = $this->visit($ctx->relationalExp($i));

            $left = $this->safeEquality($left, $right, $op);
        }

        return $left;
    }

    // ++ y --
    public function visitIncDecStmt($ctx) {

        $name = $ctx->IDENTIFIER()->getText();

        try {

            $value = $this->env->get($name);

            if (!is_numeric($value)) {
                $this->semanticError("Operador ++/-- requiere tipo numérico", $ctx);
                return null;
            }

            if ($ctx->INC()) {
                $this->env->assign($name, $value + 1);
            } else {
                $this->env->assign($name, $value - 1);
            }

        } catch (Exception $e) {
            $this->semanticError($e->getMessage(), $ctx);
        }

        return null;
    }

    public function visitRelationalExp($ctx) {

        $left = $this->visit($ctx->additiveExp(0));

        for ($i = 1; $i < count($ctx->additiveExp()); $i++) {

            $op = $ctx->getChild(2*$i-1)->getText();
            $right = $this->visit($ctx->additiveExp($i));

            $left = $this->safeRelational($left, $right, $op);
        }

        return $left;
    }
    public function visitAdditiveExp($ctx) {
        $left = $this->visit($ctx->multiplicativeExp(0));
        for ($i = 1; $i < count($ctx->multiplicativeExp()); $i++) {
            $op = $ctx->getChild(2*$i-1)->getText();
            $right = $this->visit($ctx->multiplicativeExp($i));
            if ($op === "+") $left = $this->safeAdd($left, $right);
            else if ($op === "-") $left = $this->safeSub($left, $right);
        }
        return $left;
    }
    public function visitMultiplicativeExp($ctx) {
        $left = $this->visit($ctx->unaryExp(0));
        for ($i = 1; $i < count($ctx->unaryExp()); $i++) {
            $op = $ctx->getChild(2*$i-1)->getText();
            $right = $this->visit($ctx->unaryExp($i));
            switch ($op) {
                case "*": $left = $this->safeMul($left, $right); break;
                case "/": $left = $this->safeDiv($left, $right, ""); break;
                case "%": $left = $this->safeMod($left, $right, ""); break;
            }
        }
        return $left;
    }
    public function visitUnaryExp($ctx) {
        if ($ctx->primary()) return $this->visit($ctx->primary());
        if ($ctx->MINUS()) return -$this->visit($ctx->unaryExp());
        if ($ctx->NOT()) return !$this->visit($ctx->unaryExp());
        return $this->visitChildren($ctx);
    }

    public function visitPrimary($ctx) {

    if ($ctx->LPAREN()) {
        return $this->visit($ctx->expression());
    }
        if ($ctx->INT_LITERAL()) return intval($ctx->INT_LITERAL()->getText());
        if ($ctx->FLOAT_LITERAL()) return floatval($ctx->FLOAT_LITERAL()->getText());
        if ($ctx->STRING()) return trim($ctx->STRING()->getText(), '"');
        if ($ctx->RUNE_LITERAL()) {
            $text = $ctx->RUNE_LITERAL()->getText();
            $char = substr($text, 1, -1);
            if (str_starts_with($char, '\u')) return intval(hexdec(substr($char, 2)));
            return mb_ord($char, 'UTF-8');
        }
        if ($ctx->TRUE()) return true;
        if ($ctx->FALSE()) return false;
        if ($ctx->IDENTIFIER()) {
            $name = $ctx->IDENTIFIER()->getText();
            try { return $this->env->get($name); } 
            catch (Exception $e) { $this->semanticError($e->getMessage(), $ctx); return null; }
        }
        return $this->visitChildren($ctx);
    }

    // OPERACIONES SEGURAS

    // SUMA
    private function safeAdd($left, $right) {

        $typeL = $this->inferType($left);
        $typeR = $this->inferType($right);

        // int + rune
        if (($typeL === "int" || $typeL === "rune") &&
            ($typeR === "int" || $typeR === "rune")) {
            return intval($left) + intval($right);
        }

        // numéricos (promoción a float)
        if (in_array($typeL, ["int","float","rune"]) &&
            in_array($typeR, ["int","float","rune"])) {
            return floatval($left) + floatval($right);
        }

        // string + string
        if ($typeL === "string" && $typeR === "string") {
            return strval($left) . strval($right);
        }

        // ERROR (faltaba esto)
        $this->semanticError("Tipos incompatibles en suma");
        return 0;
    }


    // RESTA
    private function safeSub($left, $right) {
        $typeL = $this->inferType($left);
        $typeR = $this->inferType($right);

        if (in_array($typeL, ["int","float","rune"]) &&
            in_array($typeR, ["int","float","rune"])) {

            if ($typeL === "float" || $typeR === "float") {
                return floatval($left) - floatval($right);
            }

            return intval($left) - intval($right);
        }

        $this->semanticError("Tipos incompatibles en resta");
        return null;
    }

    // MULTIPLICACIÓN
    private function safeMul($a, $b) {

    if ($a === null || $b === null) {
        $this->semanticError("Operación con valor null en multiplicación");
        return 0;
    }

        // string * int
        if (is_string($a) && is_int($b)) {
            return str_repeat($a, $b);
        }
        if (is_string($b) && is_int($a)) {
            return str_repeat($b, $a);
        }

        // numéricos (int, float, rune)
        if (is_numeric($a) && is_numeric($b)) {

            // promoción a float
            if (is_float($a) || is_float($b)) {
                return floatval($a) * floatval($b);
            }

            // ambos enteros
            return intval($a) * intval($b);
        }

        $this->semanticError("Tipos incompatibles en multiplicación");
        return 0;
    }

    // DIVISIÓN
        private function safeDiv($a, $b, $ctx) {

        if (!is_numeric($a) || !is_numeric($b)) {
            $this->semanticError("Tipos incompatibles en división");
            return 0;
        }

        if ($b == 0) {
            $this->semanticError("División por cero");
            return 0;
        }

        if (is_float($a) || is_float($b)) {
            return floatval($a) / floatval($b);
        }

        // división entera
        return intval($a / $b);
    }


    // MÓDULO
    private function safeMod($a, $b, $ctx) {

        if (!is_numeric($a) || !is_numeric($b) || is_float($a) || is_float($b)) {
            $this->semanticError("Tipos incompatibles en módulo");
            return 0;
        }

        if ($b == 0) {
            $this->semanticError("Módulo por cero");
            return 0;
        }

        return intval($a) % intval($b);
    }

    // ==
    private function safeEquality($a, $b, $op) {

        $typeL = $this->inferType($a);
        $typeR = $this->inferType($b);

        // numéricos (int, float, rune)
        if (in_array($typeL, ["int","float","rune"]) &&
            in_array($typeR, ["int","float","rune"])) {

            $a = floatval($a);
            $b = floatval($b);

            return ($op === "==") ? ($a == $b) : ($a != $b);
        }

        // bool con bool
        if ($typeL === "bool" && $typeR === "bool") {
            return ($op === "==") ? ($a == $b) : ($a != $b);
        }

        // string con string
        if ($typeL === "string" && $typeR === "string") {
            return ($op === "==") ? ($a === $b) : ($a !== $b);
        }

        $this->semanticError("Tipos incompatibles en comparación de igualdad");
        return false;
    }

    // Operaciones Relacionales
    private function safeRelational($a, $b, $op) {

        $typeL = $this->inferType($a);
        $typeR = $this->inferType($b);

        // numéricos
        if (in_array($typeL, ["int","float","rune"]) &&
            in_array($typeR, ["int","float","rune"])) {

            $a = floatval($a);
            $b = floatval($b);

            switch ($op) {
                case ">":  return $a > $b;
                case ">=": return $a >= $b;
                case "<":  return $a < $b;
                case "<=": return $a <= $b;
            }
        }

        // string con string
        if ($typeL === "string" && $typeR === "string") {

            switch ($op) {
                case ">":  return $a > $b;
                case ">=": return $a >= $b;
                case "<":  return $a < $b;
                case "<=": return $a <= $b;
            }
        }

        $this->semanticError("Tipos incompatibles en comparación relacional");
        return false;
    }

    // Sentencias de Control de flujo
    // IF
    public function visitIfStmt($ctx) {

        $previousEnv = $this->env;

        // Crear scope del if
        $this->env = new Environment($previousEnv);

        // Ejecutar simpleStmt si existe
        if ($ctx->simpleStmt()) {
            $this->visit($ctx->simpleStmt());
        }

        // Evaluar condición
        $condition = $this->visit($ctx->expression());

        if (!is_bool($condition)) {
            $this->semanticError("La condición del if debe ser bool", $ctx);
            $this->env = $previousEnv;
            return null;
        }

        // Ejecutar bloque correspondiente
        if ($condition) {

            // Ejecuta bloque principal
            $this->visit($ctx->block(0));

        } else {

            if ($ctx->ELSE()) {

                // else if
                if ($ctx->ifStmt()) {
                    $this->visit($ctx->ifStmt());
                }
                // else normal
                else if (count($ctx->block()) > 1) {
                    $this->visit($ctx->block(1));
                }
            }
        }

        // Restaurar entorno (scope del if muere aquí)
        $this->env = $previousEnv;

        return null;
    }


    // SWITCH
    public function visitSwitchStmt($ctx) {

        // Evaluar expresión principal del switch
        $switchValue = $this->visit($ctx->expression());

        $matched = false;

        // Recorrer cada case
        foreach ($ctx->caseClause() as $caseCtx) {

            if ($matched) break;

            // Obtener lista de expresiones del case (expList)
            $expressions = $caseCtx->expList()->expression();

            foreach ($expressions as $exp) {

                $caseValue = $this->visit($exp);

                // Validar tipos
                $typeSwitch = $this->inferType($switchValue);
                $typeCase   = $this->inferType($caseValue);

                if ($typeSwitch !== $typeCase) {
                    $this->semanticError("Tipos incompatibles en case", $caseCtx);
                    return null;
                }

                // Comparación usando tu sistema seguro
                if ($this->safeEquality($switchValue, $caseValue, "==")) {

                    $matched = true;

                    // Ejecutar statements del case
                    foreach ($caseCtx->statement() as $stmt) {
                        $this->visit($stmt);
                    }

                    break;
                }
            }
        }

        // Si ningún case coincidió → ejecutar default
        if (!$matched && $ctx->defaultClause()) {

            foreach ($ctx->defaultClause()->statement() as $stmt) {
                $this->visit($stmt);
            }
        }

        return null;
    }

    // FOR
    public function visitForStmt($ctx) {

        $previousEnv = $this->env;

        // El for SI crea scope propio
        $this->env = new Environment($previousEnv);

        // FOR CON forClause
        if ($ctx->forClause()) {

            $clause = $ctx->forClause();

            // Inicialización
            $this->visit($clause->simpleStmt(0));

            while (true) {

                // Condición
                $condition = $this->visit($clause->expression());

                if (!is_bool($condition)) {
                    $this->semanticError("La condición del for debe ser bool", $ctx);
                    break;
                }

                if (!$condition) break;

                // Ejecutar bloque
                $this->visit($ctx->block());

                // Incremento / actualización
                $this->visit($clause->simpleStmt(1));
            }
        }

        // FOR tipo while
        else if ($ctx->expression()) {

            while (true) {

                $condition = $this->visit($ctx->expression());

                if (!is_bool($condition)) {
                    $this->semanticError("La condición del for debe ser bool", $ctx);
                    break;
                }

                if (!$condition) break;

                $this->visit($ctx->block());
            }
        }

        // FOR infinito
        else {

            while (true) {
                $this->visit($ctx->block());
            }
        }

        // Restaurar entorno
        $this->env = $previousEnv;

        return null;
    }



}
