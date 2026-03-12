<?php

require_once __DIR__ . '/SymbolTable.php';
require_once __DIR__ . '/Symbol.php';

use generated\GolampiBaseVisitor;

class Interpreter extends GolampiBaseVisitor {
    private $functions = [];
    private $env;
    private $output = "";
    private $errorReport;

    // ← CONTROL DE DEBUG: cambiar a false para quitar los mensajes
    private $debugMode = false;

    // Constructor
    public function __construct($environment, $errorReport) {
        $this->env         = $environment;
        $this->errorReport = $errorReport;
    }

    // Retorna la salida generada
    public function getOutput() {
        return $this->output;
    }

    // ── Debug helper ──────────────────────────────────────────────────────────
    // Imprime mensajes de debug (solo si debugMode = true)
    private function dbg(string $msg) {
        if ($this->debugMode) {
            $this->output .= "[DBG] $msg\n";
        }
    }

    // Convierte cualquier valor a string legible para debug
    private function dumpVal($v): string {
        if ($v instanceof PointerValue) return "PointerValue->&{$v->name}";
        if (is_array($v))  return "array[" . count($v) . "](" . implode(",", array_map([$this, 'dumpVal'], array_slice($v, 0, 6))) . ")";
        if (is_bool($v))   return $v ? "true" : "false";
        if ($v === null)   return "null";
        return (string)$v;
    }
    // ─────────────────────────────────────────────────────────────────────────

    // Agrega texto a la salida con salto de línea
    private function println($text) {
        if (is_bool($text)) $text = $text ? "true" : "false";
        $this->output .= $text . "\n";
    }

    // Registra un error semántico en el reporte
    private function semanticError($message, $ctx = null) {
        $line   = 0;
        $column = 0;
        if ($ctx != null && $ctx->start != null) {
            $line   = $ctx->start->getLine();
            $column = $ctx->start->getCharPositionInLine();
        }
        $this->dbg("⚠ ERROR SEMANTICO: $message (L$line:C$column)");
        $this->errorReport->add("Semántico", $message, $line, $column);
    }

    // Infiere el tipo de un valor PHP al tipo Golampi
    private function inferType($value) {
        if ($value instanceof PointerValue) return "pointer";
        if (is_array($value))  return "array";
        if (is_int($value))    return "int";
        if (is_float($value))  return "float";
        if (is_bool($value))   return "bool";
        if ($value === null)   return "nil";
        if (is_string($value)) return (mb_strlen($value) === 1) ? "rune" : "string";
        return "int";
    }

    // Obtiene el tipo Golampi desde el contexto de la gramática
    private function getTypeFromCtx($typeCtx) {
        if ($typeCtx == null) return null;

        // Detectar puntero: *int, *float, *[5]int, etc.
        if ($typeCtx->pointerType() !== null) return "pointer";

        // Detectar array
        if ($typeCtx->arrayType() !== null) return "array";

        $text = $typeCtx->getText();
        switch ($text) {
            case "int": case "int32": return "int";
            case "float": case "float32": return "float";
            case "bool":   return "bool";
            case "string": return "string";
            case "rune":   return "rune";
            default:       return "int";
        }
    }

    // Verifica si un tipo de la gramática es puntero (*T)
    private function isPointerType($typeCtx): bool {
        if ($typeCtx === null) return false;
        return ($typeCtx->pointerType() !== null);
    }

    // Extrae el nombre de variable del operador & (address-of)
    private function extractAddressTarget($unaryCtx) {
        if ($unaryCtx->primary()) {
            $primary = $unaryCtx->primary();
            if ($primary->IDENTIFIER()) {
                return $primary->IDENTIFIER()->getText();
            }
        }
        return null;
    }

    // PROGRAMA
    // Punto de entrada: registra funciones y ejecuta main()
    public function visitProgram($ctx) {

        $this->dbg("=== visitProgram: registrando funciones ===");

        foreach ($ctx->functionDecl() as $func) {
            $this->visit($func);
        }


        $this->dbg("Funciones registradas: [" . implode(", ", array_keys($this->functions)) . "]");

        if (isset($this->functions["main"])) {
            $this->dbg(">>> Ejecutando main...");
            $this->executeFunction("main", []);
            $this->dbg(">>> main terminó");
        } else {
            $this->semanticError("No se encontró la función main");
        }

        return null;
    }

    // FUNCIONES
    // Declaración de función: guarda nombre, parámetros y bloque
    public function visitFunctionDecl($ctx) {

        $name   = $ctx->IDENTIFIER()->getText();
        $params = [];

        if ($ctx->params()) {
            foreach ($ctx->params()->param() as $param) {
                $paramName = $param->IDENTIFIER()->getText();
                $typeCtx   = $param->type();
                $isPointer = $this->isPointerType($typeCtx);
                $typeText  = $typeCtx->getText();

                $this->dbg("  func '$name': param '$paramName' type='$typeText' isPointer=" . ($isPointer ? "SI" : "NO"));

                $params[] = [
                    'name'      => $paramName,
                    'isPointer' => $isPointer,
                ];
            }
        }

        $this->functions[$name] = (object)[
            "params" => $params,
            "block"  => $ctx->block()
        ];

        // Registrar la función en la tabla de símbolos
        $token = $ctx->IDENTIFIER()->getSymbol();
        $symbol = new Symbol(
            $name,
            "función",
            "—",
            "global",
            $token->getLine(),
            $token->getCharPositionInLine(),
            false
        );
        SymbolTable::getInstance()->add($symbol);

        return null;
    }

    // Ejecuta una función de usuario con sus argumentos
    private function executeFunction($name, $args) {

        if (!isset($this->functions[$name])) {
            throw new Exception("Función '$name' no definida");
        }

        $function = $this->functions[$name];

        $this->dbg("── CALL '$name' con " . count($args) . " arg(s)");

        if (count($args) !== count($function->params)) {
            throw new Exception("Cantidad incorrecta de argumentos en '$name'");
        }

        $previousEnv = $this->env;
        $this->env   = new Environment($previousEnv, $name);  // ámbito = nombre de la función

        try {

            for ($i = 0; $i < count($args); $i++) {

                $param = $function->params[$i];
                $arg   = $args[$i];
                $argType = $this->inferType($arg);

                $this->dbg("  ARG[{$i}] '{$param['name']}' isPointer=" . ($param['isPointer'] ? "SI" : "NO") . " argType=$argType val=" . $this->dumpVal($arg));

                if ($param['isPointer']) {
                    if (!($arg instanceof PointerValue)) {
                        throw new Exception(
                            "Se esperaba &var para el parámetro '{$param['name']}', recibió tipo: $argType"
                        );
                    }
                    $this->env->define($param['name'], 'pointer', $arg, 0, 0);
                    $this->dbg("  → '{$param['name']}' = PointerValue(&{$arg->name})");
                } else {
                    $this->env->define($param['name'], $argType, $arg, 0, 0);
                    $this->dbg("  → '{$param['name']}' tipo=$argType val=" . $this->dumpVal($arg));
                }
            }

            $this->dbg("  → ejecutando bloque de '$name'");
            $this->visit($function->block);
            $this->dbg("  → '$name' terminó sin return explícito");

        } catch (ReturnException $e) {
            $this->env = $previousEnv;
            $this->dbg("  → '$name' RETURN: " . $this->dumpVal($e->value));
            return $e->value;
        }

        $this->env = $previousEnv;
        return null;
    }

    // BLOQUES
    // Bloque de código: crea nuevo scope y ejecuta statements
    public function visitBlock($ctx) {
        $previous  = $this->env;
        $this->env = new Environment($previous);
        foreach ($ctx->statement() as $stmt) {
            // Cada statement es independiente — un error no detiene los siguientes
            try {
                $this->visit($stmt);
            } catch (ReturnException $e) {
                // return debe propagarse siempre
                $this->env = $previous;
                throw $e;
            } catch (BreakException $e) {
                // break debe propagarse siempre
                $this->env = $previous;
                throw $e;
            } catch (ContinueException $e) {
                // continue debe propagarse siempre
                $this->env = $previous;
                throw $e;
            } catch (Throwable $e) {
                // Cualquier otro error: registrar y continuar con el siguiente stmt
                $line = 0;
                if (method_exists($stmt, 'start') && $stmt->start !== null) {
                    $line = $stmt->start->getLine();
                }
                $this->semanticError("Error en sentencia: " . $e->getMessage(), $stmt);
            }
        }
        $this->env = $previous;
        return null;
    }

    // Statement genérico
    public function visitStatement($ctx)     { return $this->visitChildren($ctx); }
    public function visitStatementCore($ctx) { return $this->visitChildren($ctx); }

    // FUNCIONES BUILT-IN
    // Llamada a función (built-ins y funciones de usuario)
    public function visitFunctionCall($ctx) {

        $name = $ctx->functionName()->getText();

        if ($name === "fmt.Println") {
            $values = [];
            if ($ctx->args()) {
                foreach ($ctx->args()->expList()->expression() as $exp) {
                    $value = $this->visit($exp);
                    if (is_bool($value)) $value = $value ? "true" : "false";
                    $values[] = $value;
                }
            }
            $this->dbg("fmt.Println → [" . implode(", ", array_map(fn($v) => $this->dumpVal($v), $values)) . "]");
            $this->output .= implode(" ", $values) . "\n";
            return null;
        }

        /* =============================
        BUILT-IN: len
        Retorna la longitud de un string o arreglo
        ============================== */
        if ($name === "len") {
            if (!$ctx->args()) {
                $this->semanticError("len() requiere un argumento", $ctx);
                return null;
            }
            $val = $this->visit($ctx->args()->expList()->expression(0));
            if (is_string($val)) {
                return mb_strlen($val, 'UTF-8');
            }
            if (is_array($val)) {
                return count($val);
            }
            $this->semanticError("len() requiere un string o arreglo", $ctx);
            return null;
        }

        /* =============================
        BUILT-IN: now
        Retorna fecha y hora actual como string
        ============================== */
        if ($name === "now") {
            return date("Y-m-d H:i:s");
        }

        /* =============================
        BUILT-IN: substr
        Extrae subcadena: substr(s, inicio, longitud)
        ============================== */
        if ($name === "substr") {
            if (!$ctx->args()) {
                $this->semanticError("substr() requiere 3 argumentos", $ctx);
                return null;
            }
            $exprs = $ctx->args()->expList()->expression();
            if (count($exprs) !== 3) {
                $this->semanticError("substr() requiere exactamente 3 argumentos: substr(s, inicio, longitud)", $ctx);
                return null;
            }
            $str    = $this->visit($exprs[0]);
            $inicio = $this->visit($exprs[1]);
            $largo  = $this->visit($exprs[2]);

            if (!is_string($str)) {
                $this->semanticError("substr(): el primer argumento debe ser string", $ctx);
                return null;
            }
            if (!is_int($inicio) || !is_int($largo)) {
                $this->semanticError("substr(): inicio y longitud deben ser int", $ctx);
                return null;
            }
            $len = mb_strlen($str, 'UTF-8');
            if ($inicio < 0 || $inicio >= $len) {
                $this->semanticError("substr(): índice inicial fuera de rango ($inicio)", $ctx);
                return null;
            }
            if ($largo < 0 || $inicio + $largo > $len) {
                $this->semanticError("substr(): longitud inválida ($largo)", $ctx);
                return null;
            }
            return mb_substr($str, $inicio, $largo, 'UTF-8');
        }

        /* =============================
        BUILT-IN: typeOf
        Retorna el tipo de una variable como string
        ============================== */
        if ($name === "typeOf") {
            if (!$ctx->args()) {
                $this->semanticError("typeOf() requiere un argumento", $ctx);
                return null;
            }
            $val  = $this->visit($ctx->args()->expList()->expression(0));
            $type = $this->inferType($val);

            // Mapear a los nombres del lenguaje Golampi
            switch ($type) {
                case "int":     return "int";
                case "float":   return "float32";
                case "bool":    return "bool";
                case "string":  return "string";
                case "rune":    return "rune";
                case "pointer": return "pointer";
                case "array":   return "array";
                case "nil":     return "nil";
                default:        return $type;
            }
        }

        /* =============================
        FUNCIONES DEL USUARIO
        ============================== */
        $args = [];
        if ($ctx->args()) {
            foreach ($ctx->args()->expList()->expression() as $exp) {
                $val = $this->visit($exp);
                $this->dbg("  preparando arg para '$name': tipo=" . $this->inferType($val) . " val=" . $this->dumpVal($val));
                $args[] = $val;
            }
        }

        try {
            return $this->executeFunction($name, $args);
        } catch (Exception $e) {
            $this->semanticError($e->getMessage(), $ctx);
            return null;
        }
    }

    // DECLARACION DE VARIABLES Y ARREGLOS
    // Declaración de variable con var (var x int, var a [5]int)
    public function visitVarDecl($ctx) {

        if ($ctx->arrayType() !== null) {
            $name         = $ctx->IDENTIFIER()->getText();
            $arrayTypeCtx = $ctx->arrayType();
            $dimensions   = [];
            foreach ($arrayTypeCtx->arrayDimension() as $dim) {
                $dimensions[] = intval($dim->INT_LITERAL()->getText());
            }
            $baseType     = $arrayTypeCtx->baseType()->getText();
            $defaultValue = $this->getDefaultValue($baseType);
            $array        = $this->createArray($dimensions, $defaultValue);
            if ($ctx->arrayLiteral() !== null) {
                $array = $this->visit($ctx->arrayLiteral());
            }
            $this->dbg("varDecl array '$name' dims=[" . implode(",", $dimensions) . "] val=" . $this->dumpVal($array));
            $this->env->define($name, "array", $array, 0, 0);
            return null;
        }

        if ($ctx->idList() !== null) {
            $ids      = $ctx->idList()->IDENTIFIER();
            $typeCtx  = $ctx->type();
            $dataType = $this->getTypeFromCtx($typeCtx);
            $values   = [];
            if ($ctx->expList() !== null) {
                foreach ($ctx->expList()->expression() as $exp) {
                    $values[] = $this->visit($exp);
                }
            }
            for ($i = 0; $i < count($ids); $i++) {
                $name  = $ids[$i]->getText();
                $value = $values[$i] ?? null;

                // ← NUEVO: si el tipo declarado es array y no hay valor,
                // construir el arreglo con valores por defecto
                if ($dataType === "array" && $value === null) {
                    $arrayTypeCtx = $typeCtx->arrayType();
                    $dimensions   = [];
                    foreach ($arrayTypeCtx->arrayDimension() as $dim) {
                        $dimensions[] = intval($dim->INT_LITERAL()->getText());
                    }
                    $baseType = $arrayTypeCtx->baseType()->getText();
                    $value    = $this->createArray($dimensions, $this->getDefaultValue($baseType));
                }

                $this->dbg("varDecl '$name' tipo=$dataType val=" . $this->dumpVal($value));
                $this->env->define($name, $dataType, $value, 0, 0);
            }
            return null;
        }

        throw new \Exception("Error interno en varDecl");
    }

    // :=
    // Declaración corta := (x := 10)
    public function visitShortVarDecl($ctx) {

        $ids    = $ctx->idList()->IDENTIFIER();
        $idNames = [];
        foreach ($ids as $id) $idNames[] = $id->getText();
        $this->dbg("shortVarDecl: ids=[" . implode(",", $idNames) . "]");

        $values = [];
        foreach ($ctx->expList()->expression() as $exp) {
            $val = $this->visit($exp);
            $this->dbg("  exp → tipo=" . $this->inferType($val) . " val=" . $this->dumpVal($val));
            $values[] = $val;
        }

        // Solo desempaquetar multi-retorno cuando hay múltiples destinos
        if (count($ids) > 1 && count($values) === 1 && is_array($values[0])) {
            $values = $values[0];
        }

        for ($i = 0; $i < count($ids); $i++) {
            $token    = $ids[$i]->getSymbol();
            $name     = $ids[$i]->getText();
            $value    = $values[$i] ?? null;
            $line     = $token->getLine();
            $column   = $token->getCharPositionInLine();
            $dataType = $this->inferType($value);

            $this->dbg("  define '$name' tipo=$dataType val=" . $this->dumpVal($value));

            try {
                $this->env->define($name, $dataType, $value, $line, $column);
            } catch (Exception $e) {
                $this->semanticError($e->getMessage(), $ctx);
            }
        }

        return null;
    }

    // := en for
    // Declaración corta := dentro de for (init de forClause)
    public function visitShortVarDeclNoSemi($ctx) {

        $ids    = $ctx->idList()->IDENTIFIER();
        $values = [];

        foreach ($ctx->expList()->expression() as $exp) {
            $values[] = $this->visit($exp);
        }

        if (count($ids) > 1 && count($values) === 1 && is_array($values[0])) {
            $values = $values[0];
        }

        for ($i = 0; $i < count($ids); $i++) {
            $token    = $ids[$i]->getSymbol();
            $name     = $ids[$i]->getText();
            $value    = $values[$i] ?? null;
            $line     = $token->getLine();
            $column   = $token->getCharPositionInLine();
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
    // Asignación (=, +=, -=, *=, /=) — soporta variables, arreglos y punteros
    public function visitAssignment($ctx) {

        $op = $ctx->assignOp()->getText();

        /* CASO A: *ptr = value */
        if ($ctx->assignTarget()->pointerAccess()) {

            $ptrCtx = $ctx->assignTarget()->pointerAccess();
            $name   = $ptrCtx->IDENTIFIER()->getText();
            $mults  = count($ptrCtx->MULT());
            $value  = $this->visit($ctx->expList()->expression(0));

            $this->dbg("assignment *ptr '$name' mults=$mults value=" . $this->dumpVal($value));

            try {
                $ptr = $this->env->get($name);
                $this->dbg("  ptr raw = " . $this->dumpVal($ptr));

                for ($d = 0; $d < $mults - 1; $d++) {
                    if (!($ptr instanceof PointerValue)) {
                        $this->semanticError("No se puede desreferenciar '$name'", $ctx);
                        return null;
                    }
                    $ptr = $ptr->getValue();
                }

                if (!($ptr instanceof PointerValue)) {
                    $this->semanticError("'$name' no es un puntero", $ctx);
                    return null;
                }

                $this->dbg("  setValue en '{$ptr->name}' ← " . $this->dumpVal($value));
                $ptr->setValue($value);

            } catch (Exception $e) {
                $this->semanticError($e->getMessage(), $ctx);
            }

            return null;
        }

        /* CASO B: a[i] = value */
        if ($ctx->assignTarget()->arrayAccess()) {

            $arrayCtx  = $ctx->assignTarget()->arrayAccess();
            $name      = $arrayCtx->IDENTIFIER()->getText();

            try {
                $raw = $this->env->get($name);
            } catch (Exception $e) {
                $this->semanticError($e->getMessage(), $ctx);
                return null;
            }

            $isPointer = ($raw instanceof PointerValue);
            $array     = $isPointer ? $raw->getValue() : $raw;

            $this->dbg("assignment array '$name'[$op] isPointer=" . ($isPointer ? "SI" : "NO") . " before=" . $this->dumpVal($array));

            $value = $this->visit($ctx->expList()->expression(0));
            $ref   =& $array;

            foreach ($arrayCtx->arrayIndex() as $indexCtx) {
                $index = $this->visit($indexCtx->expression());
                if (!is_int($index)) { $this->semanticError("Índice debe ser int", $ctx); return null; }
                if (!is_array($ref) || $index < 0 || $index >= count($ref)) {
                    $this->semanticError("Índice fuera de rango [$index] en '$name'", $ctx);
                    return null;
                }
                $ref =& $ref[$index];
            }

            switch ($op) {
                case "=":  $ref = $value; break;
                case "+=": $ref = $this->safeAdd($ref, $value); break;
                case "-=": $ref = $this->safeSub($ref, $value); break;
                case "*=": $ref = $this->safeMul($ref, $value); break;
                case "/=": $ref = $this->safeDiv($ref, $value, $name); break;
                default:   $ref = $value;
            }

            if ($isPointer) {
                $this->dbg("  write-back via ptr '{$raw->name}' after=" . $this->dumpVal($array));
                $raw->setValue($array);
            } else {
                $this->env->assign($name, $array);
            }

            return null;
        }

        /* CASO C: variables normales */
        $ids    = $ctx->assignTarget()->idList()->IDENTIFIER();
        $values = [];

        foreach ($ctx->expList()->expression() as $exp) {
            $values[] = $this->visit($exp);
        }

        if (count($ids) > 1 && count($values) === 1 && is_array($values[0])) {
            $values = $values[0];
        }

        for ($i = 0; $i < count($ids); $i++) {

            $name  = $ids[$i]->getText();
            $value = $values[$i] ?? null;

            try {
                $current = $this->env->get($name);

                switch ($op) {
                    case "=":  $newValue = $value; break;
                    case "+=": $newValue = $this->safeAdd($current, $value); break;
                    case "-=": $newValue = $this->safeSub($current, $value); break;
                    case "*=": $newValue = $this->safeMul($current, $value); break;
                    case "/=": $newValue = $this->safeDiv($current, $value, $name); break;
                    default:   $newValue = $value;
                }

                $this->dbg("assignment '$name' $op " . $this->dumpVal($value) . " → " . $this->dumpVal($newValue));
                $this->env->assign($name, $newValue);

            } catch (Exception $e) {
                $this->semanticError($e->getMessage(), $ctx);
            }
        }

        return null;
    }

    // Asignacion en for
    // Asignación dentro de for (post de forClause)
    public function visitAssignmentNoSemi($ctx) {

        $op = $ctx->assignOp()->getText();

        if ($ctx->assignTarget()->pointerAccess()) {
            $ptrCtx = $ctx->assignTarget()->pointerAccess();
            $name   = $ptrCtx->IDENTIFIER()->getText();
            $mults  = count($ptrCtx->MULT());
            $value  = $this->visit($ctx->expList()->expression(0));
            try {
                $ptr = $this->env->get($name);
                for ($d = 0; $d < $mults - 1; $d++) {
                    if (!($ptr instanceof PointerValue)) { $this->semanticError("No se puede desreferenciar '$name'", $ctx); return null; }
                    $ptr = $ptr->getValue();
                }
                if (!($ptr instanceof PointerValue)) { $this->semanticError("'$name' no es un puntero", $ctx); return null; }
                $ptr->setValue($value);
            } catch (Exception $e) {
                $this->semanticError($e->getMessage(), $ctx);
            }
            return null;
        }

        if ($ctx->assignTarget()->arrayAccess()) {
            $arrayCtx = $ctx->assignTarget()->arrayAccess();
            $name     = $arrayCtx->IDENTIFIER()->getText();
            try { $raw = $this->env->get($name); }
            catch (Exception $e) { $this->semanticError($e->getMessage(), $ctx); return null; }
            $isPointer = ($raw instanceof PointerValue);
            $array     = $isPointer ? $raw->getValue() : $raw;
            $value     = $this->visit($ctx->expList()->expression(0));
            $ref       =& $array;
            foreach ($arrayCtx->arrayIndex() as $indexCtx) {
                $index = $this->visit($indexCtx->expression());
                if (!is_int($index) || !is_array($ref) || $index < 0 || $index >= count($ref)) {
                    $this->semanticError("Índice inválido en '$name'", $ctx); return null;
                }
                $ref =& $ref[$index];
            }
            switch ($op) {
                case "=":  $ref = $value; break;
                case "+=": $ref = $this->safeAdd($ref, $value); break;
                case "-=": $ref = $this->safeSub($ref, $value); break;
                case "*=": $ref = $this->safeMul($ref, $value); break;
                case "/=": $ref = $this->safeDiv($ref, $value, ""); break;
                default:   $ref = $value;
            }
            if ($isPointer) { $raw->setValue($array); }
            else { $this->env->assign($name, $array); }
            return null;
        }

        $ids    = $ctx->assignTarget()->idList()->IDENTIFIER();
        $values = [];
        foreach ($ctx->expList()->expression() as $exp) { $values[] = $this->visit($exp); }
        if (count($ids) > 1 && count($values) === 1 && is_array($values[0])) { $values = $values[0]; }
        for ($i = 0; $i < count($ids); $i++) {
            $name  = $ids[$i]->getText();
            $value = $values[$i] ?? null;
            try {
                $current = $this->env->get($name);
                switch ($op) {
                    case "=":  $newValue = $value; break;
                    case "+=": $newValue = $this->safeAdd($current, $value); break;
                    case "-=": $newValue = $this->safeSub($current, $value); break;
                    case "*=": $newValue = $this->safeMul($current, $value); break;
                    case "/=": $newValue = $this->safeDiv($current, $value, ""); break;
                    default:   $newValue = $value;
                }
                $this->env->assign($name, $newValue);
            } catch (Exception $e) { $this->semanticError($e->getMessage(), $ctx); }
        }
        return null;
    }

    // CONSTANTES
    // Declaración de constante con const
    public function visitConstDecl($ctx) {
        $token    = $ctx->IDENTIFIER()->getSymbol();
        $name     = $ctx->IDENTIFIER()->getText();
        $dataType = $this->getTypeFromCtx($ctx->type());
        $value    = $this->visit($ctx->expression());
        $line     = $token->getLine();
        $column   = $token->getCharPositionInLine();
        try { $this->env->defineConst($name, $dataType, $value, $line, $column); }
        catch (Exception $e) { $this->semanticError($e->getMessage(), $ctx); }
        return null;
    }

    // EXPRESIONES
    // Expresión — delega al nivel OR
    public function visitExpression($ctx)    { return $this->visit($ctx->logicalOrExp()); }

    // Operador lógico OR (||)
    public function visitLogicalOrExp($ctx) {
        $result = $this->visit($ctx->logicalAndExp(0));
        if (count($ctx->logicalAndExp()) > 1) {
            if (!is_bool($result)) { $this->semanticError("|| requiere bool", $ctx); return null; }
            for ($i = 1; $i < count($ctx->logicalAndExp()); $i++) {
                if ($result === true) return true;
                $right = $this->visit($ctx->logicalAndExp($i));
                if (!is_bool($right)) { $this->semanticError("|| requiere bool", $ctx); return null; }
                $result = $result || $right;
            }
        }
        return $result;
    }

    // Operador lógico AND (&&)
    public function visitLogicalAndExp($ctx) {
        $result = $this->visit($ctx->equalityExp(0));
        if (count($ctx->equalityExp()) > 1) {
            if (!is_bool($result)) { $this->semanticError("&& requiere bool", $ctx); return null; }
            for ($i = 1; $i < count($ctx->equalityExp()); $i++) {
                if ($result === false) return false;
                $right = $this->visit($ctx->equalityExp($i));
                if (!is_bool($right)) { $this->semanticError("&& requiere bool", $ctx); return null; }
                $result = $result && $right;
            }
        }
        return $result;
    }

    // Operadores de igualdad (== y !=)
    public function visitEqualityExp($ctx) {
        $left = $this->visit($ctx->relationalExp(0));
        for ($i = 1; $i < count($ctx->relationalExp()); $i++) {
            $op    = $ctx->getChild(2*$i-1)->getText();
            $right = $this->visit($ctx->relationalExp($i));
            $left  = $this->safeEquality($left, $right, $op);
        }
        return $left;
    }

    // Incremento y decremento (++ y --)
    public function visitIncDecStmt($ctx) {
        $name = $ctx->IDENTIFIER()->getText();
        try {
            $value = $this->env->get($name);
            if (!is_numeric($value)) { $this->semanticError("++/-- requiere numérico", $ctx); return null; }
            $this->env->assign($name, $ctx->INC() ? $value + 1 : $value - 1);
        } catch (Exception $e) { $this->semanticError($e->getMessage(), $ctx); }
        return null;
    }

    // Operadores relacionales (>, >=, <, <=)
    public function visitRelationalExp($ctx) {
        $left = $this->visit($ctx->additiveExp(0));
        for ($i = 1; $i < count($ctx->additiveExp()); $i++) {
            $op    = $ctx->getChild(2*$i-1)->getText();
            $right = $this->visit($ctx->additiveExp($i));
            $left  = $this->safeRelational($left, $right, $op);
        }
        return $left;
    }

    // Operadores aditivos (+ y -)
    public function visitAdditiveExp($ctx) {
        $left = $this->visit($ctx->multiplicativeExp(0));
        for ($i = 1; $i < count($ctx->multiplicativeExp()); $i++) {
            $op    = $ctx->getChild(2*$i-1)->getText();
            $right = $this->visit($ctx->multiplicativeExp($i));
            if ($op === "+") $left = $this->safeAdd($left, $right);
            else if ($op === "-") $left = $this->safeSub($left, $right);
        }
        return $left;
    }

    // Operadores multiplicativos (*, /, %)
    public function visitMultiplicativeExp($ctx) {
        $left = $this->visit($ctx->unaryExp(0));
        for ($i = 1; $i < count($ctx->unaryExp()); $i++) {
            $op    = $ctx->getChild(2*$i-1)->getText();
            $right = $this->visit($ctx->unaryExp($i));
            switch ($op) {
                case "*": $left = $this->safeMul($left, $right); break;
                case "/": $left = $this->safeDiv($left, $right, ""); break;
                case "%": $left = $this->safeMod($left, $right, ""); break;
            }
        }
        return $left;
    }

    // UNARY — & y *
    // Expresión unaria: negación (-), NOT (!), referencia (&), desreferencia (*)
    public function visitUnaryExp($ctx) {

        if ($ctx->primary()) return $this->visit($ctx->primary());
        if ($ctx->MINUS())   return -$this->visit($ctx->unaryExp());
        if ($ctx->NOT())     return !$this->visit($ctx->unaryExp());

        // &x → referencia
        if ($ctx->AMP()) {
            $innerCtx = $ctx->unaryExp();
            $varName  = $this->extractAddressTarget($innerCtx);

            $this->dbg("unaryExp &: extrayendo variable → '" . ($varName ?? "NULL") . "'");

            if ($varName === null) {
                $this->semanticError("El operador & solo se aplica a variables", $ctx);
                return null;
            }

            try {
                $targetEnv = $this->env->getEnvFor($varName);
                $ptr       = new PointerValue($targetEnv, $varName);
                $this->dbg("  → creado PointerValue(&$varName), val apuntado=" . $this->dumpVal($targetEnv->get($varName)));
                return $ptr;
            } catch (Exception $e) {
                $this->semanticError($e->getMessage(), $ctx);
                return null;
            }
        }

        // *expr → desreferenciación
        if ($ctx->MULT()) {
            $ptr = $this->visit($ctx->unaryExp());
            $this->dbg("unaryExp *: val=" . $this->dumpVal($ptr));
            if (!($ptr instanceof PointerValue)) {
                $this->semanticError("No se puede desreferenciar: no es un puntero", $ctx);
                return null;
            }
            return $ptr->getValue();
        }

        return $this->visitChildren($ctx);
    }

    // POINTER ACCESS — *varName, **varName
    // Lectura de puntero: *var o **var
    public function visitPointerAccess($ctx) {

        $name  = $ctx->IDENTIFIER()->getText();
        $mults = count($ctx->MULT());

        $this->dbg("visitPointerAccess '$name' mults=$mults");

        try {
            $value = $this->env->get($name);
        } catch (Exception $e) {
            $this->semanticError($e->getMessage(), $ctx);
            return null;
        }

        $this->dbg("  valor inicial = " . $this->dumpVal($value));

        for ($i = 0; $i < $mults; $i++) {
            if (!($value instanceof PointerValue)) {
                $this->semanticError("No se puede desreferenciar '$name': no es puntero", $ctx);
                return null;
            }
            $value = $value->getValue();
            $this->dbg("  desref[$i] → " . $this->dumpVal($value));
        }

        return $value;
    }

    // PRIMARY
    // Expresión primaria: literales, identificadores, llamadas, arreglos
    public function visitPrimary($ctx) {

        if ($ctx->LPAREN())        return $this->visit($ctx->expression());
        if ($ctx->INT_LITERAL())   return intval($ctx->INT_LITERAL()->getText());
        if ($ctx->FLOAT_LITERAL()) return floatval($ctx->FLOAT_LITERAL()->getText());
        if ($ctx->STRING())        return trim($ctx->STRING()->getText(), '"');

        if ($ctx->RUNE_LITERAL()) {
            $text = $ctx->RUNE_LITERAL()->getText();
            $char = substr($text, 1, -1);
            if (str_starts_with($char, '\u')) return intval(hexdec(substr($char, 2)));
            return mb_ord($char, 'UTF-8');
        }

        if ($ctx->TRUE())  return true;
        if ($ctx->FALSE()) return false;

        if ($ctx->IDENTIFIER()) {
            $name = $ctx->IDENTIFIER()->getText();
            try {
                $val = $this->env->get($name);
                return $val;
            } catch (Exception $e) {
                $this->semanticError($e->getMessage(), $ctx);
                return null;
            }
        }

        return $this->visitChildren($ctx);
    }

    // OPERACIONES SEGURAS
    // Suma segura con verificación de tipos
    private function safeAdd($left, $right) {
        $typeL = $this->inferType($left);
        $typeR = $this->inferType($right);
        if (($typeL === "int" || $typeL === "rune") && ($typeR === "int" || $typeR === "rune")) return intval($left) + intval($right);
        if (in_array($typeL, ["int","float","rune"]) && in_array($typeR, ["int","float","rune"])) return floatval($left) + floatval($right);
        if ($typeL === "string" && $typeR === "string") return strval($left) . strval($right);
        $this->semanticError("Tipos incompatibles en suma"); return 0;
    }

    // Resta segura con verificación de tipos
    private function safeSub($left, $right) {
        $typeL = $this->inferType($left); $typeR = $this->inferType($right);
        if (in_array($typeL, ["int","float","rune"]) && in_array($typeR, ["int","float","rune"])) {
            if ($typeL === "float" || $typeR === "float") return floatval($left) - floatval($right);
            return intval($left) - intval($right);
        }
        $this->semanticError("Tipos incompatibles en resta"); return null;
    }

    // Multiplicación segura con verificación de tipos
    private function safeMul($a, $b) {
        if ($a === null || $b === null) { $this->semanticError("null en multiplicación"); return 0; }
        if (is_string($a) && is_int($b)) return str_repeat($a, $b);
        if (is_string($b) && is_int($a)) return str_repeat($b, $a);
        if (is_numeric($a) && is_numeric($b)) {
            if (is_float($a) || is_float($b)) return floatval($a) * floatval($b);
            return intval($a) * intval($b);
        }
        $this->semanticError("Tipos incompatibles en multiplicación"); return 0;
    }

    // División segura con verificación de tipos y división por cero
    private function safeDiv($a, $b, $ctx) {
        if (!is_numeric($a) || !is_numeric($b)) { $this->semanticError("Tipos incompatibles en división"); return 0; }
        if ($b == 0) { $this->semanticError("División por cero"); return 0; }
        if (is_float($a) || is_float($b)) return floatval($a) / floatval($b);
        return intval($a / $b);
    }

    // Módulo seguro con verificación de tipos
    private function safeMod($a, $b, $ctx) {
        if (!is_numeric($a) || !is_numeric($b) || is_float($a) || is_float($b)) { $this->semanticError("Tipos incompatibles en módulo"); return 0; }
        if ($b == 0) { $this->semanticError("Módulo por cero"); return 0; }
        return intval($a) % intval($b);
    }

    // Comparación de igualdad segura (== y !=)
    private function safeEquality($a, $b, $op) {
        $typeL = $this->inferType($a); $typeR = $this->inferType($b);
        if (in_array($typeL, ["int","float","rune"]) && in_array($typeR, ["int","float","rune"])) {
            return ($op === "==") ? (floatval($a) == floatval($b)) : (floatval($a) != floatval($b));
        }
        if ($typeL === "bool" && $typeR === "bool") return ($op === "==") ? ($a == $b) : ($a != $b);
        if ($typeL === "string" && $typeR === "string") return ($op === "==") ? ($a === $b) : ($a !== $b);
        $this->semanticError("Tipos incompatibles en igualdad"); return false;
    }

    // Comparación relacional segura (>, >=, <, <=)
    private function safeRelational($a, $b, $op) {
        $typeL = $this->inferType($a); $typeR = $this->inferType($b);
        if (in_array($typeL, ["int","float","rune"]) && in_array($typeR, ["int","float","rune"])) {
            $a = floatval($a); $b = floatval($b);
            switch ($op) { case ">": return $a > $b; case ">=": return $a >= $b; case "<": return $a < $b; case "<=": return $a <= $b; }
        }
        if ($typeL === "string" && $typeR === "string") {
            switch ($op) { case ">": return $a > $b; case ">=": return $a >= $b; case "<": return $a < $b; case "<=": return $a <= $b; }
        }
        $this->semanticError("Tipos incompatibles en relacional"); return false;
    }

    // CONTROL DE FLUJO
    // Sentencia if / else if / else
    public function visitIfStmt($ctx) {
        $previousEnv = $this->env;
        $this->env   = new Environment($previousEnv);
        if ($ctx->simpleStmt()) $this->visit($ctx->simpleStmt());
        $condition = $this->visit($ctx->expression());
        if (!is_bool($condition)) { $this->semanticError("condición if debe ser bool", $ctx); $this->env = $previousEnv; return null; }
        if ($condition) { $this->visit($ctx->block(0)); }
        else { if ($ctx->ELSE()) { if ($ctx->ifStmt()) $this->visit($ctx->ifStmt()); else if (count($ctx->block()) > 1) $this->visit($ctx->block(1)); } }
        $this->env = $previousEnv;
        return null;
    }

    // Sentencia switch con cases y default
    public function visitSwitchStmt($ctx) {
        $switchValue = $this->visit($ctx->expression()); $matched = false;
        try {
            foreach ($ctx->caseClause() as $caseCtx) {
                if ($matched) break;
                foreach ($caseCtx->expList()->expression() as $exp) {
                    $caseValue = $this->visit($exp);
                    if ($this->inferType($switchValue) !== $this->inferType($caseValue)) { $this->semanticError("Tipos incompatibles en case", $caseCtx); return null; }
                    if ($this->safeEquality($switchValue, $caseValue, "==")) {
                        $matched = true;
                        try { foreach ($caseCtx->statement() as $stmt) $this->visit($stmt); } catch (BreakException $e) { break 2; }
                        break;
                    }
                }
            }
            if (!$matched && $ctx->defaultClause()) {
                try { foreach ($ctx->defaultClause()->statement() as $stmt) $this->visit($stmt); } catch (BreakException $e) {}
            }
        } catch (BreakException $e) {}
        return null;
    }

    // Sentencia for: clásico (init;cond;post), while y for infinito
    public function visitForStmt($ctx) {
        $previousEnv = $this->env;
        $this->env   = new Environment($previousEnv);
        try {
            if ($ctx->forClause()) {
                $clause = $ctx->forClause();
                if ($clause->simpleStmt(0)) $this->visit($clause->simpleStmt(0));
                while (true) {
                    $condition = $this->visit($clause->expression());
                    if (!is_bool($condition)) { $this->semanticError("condición for debe ser bool", $ctx); break; }
                    if (!$condition) break;
                    try { $this->visitForBlock($ctx->block()); }
                    catch (ContinueException $e) { if ($clause->simpleStmt(1)) $this->visit($clause->simpleStmt(1)); continue; }
                    catch (BreakException $e) { break; }
                    if ($clause->simpleStmt(1)) $this->visit($clause->simpleStmt(1));
                }
            } else if ($ctx->expression()) {
                while (true) {
                    $condition = $this->visit($ctx->expression());
                    if (!is_bool($condition)) { $this->semanticError("condición for debe ser bool", $ctx); break; }
                    if (!$condition) break;
                    try { $this->visit($ctx->block()); } catch (ContinueException $e) { continue; } catch (BreakException $e) { break; }
                }
            } else {
                while (true) {
                    try { $this->visit($ctx->block()); } catch (ContinueException $e) { continue; } catch (BreakException $e) { break; }
                }
            }
        } finally { $this->env = $previousEnv; }
        return null;
    }

    // Ejecuta el bloque interno del for con su propio scope por iteración
    private function visitForBlock($blockCtx) {
        $previousEnv = $this->env;
        $this->env   = new Environment($previousEnv);
        try {
            foreach ($blockCtx->statement() as $stmt) {
                try {
                    $this->visit($stmt);
                } catch (ReturnException $e) {
                    $this->env = $previousEnv;
                    throw $e;
                } catch (BreakException $e) {
                    $this->env = $previousEnv;
                    throw $e;
                } catch (ContinueException $e) {
                    $this->env = $previousEnv;
                    throw $e;
                } catch (Throwable $e) {
                    $this->semanticError("Error en sentencia: " . $e->getMessage(), $stmt);
                }
            }
        } finally {
            $this->env = $previousEnv;
        }
    }

    // Sentencia break — lanza excepción para salir del for/switch
    public function visitBreakStmt($ctx)    { throw new BreakException(); }
    // Sentencia continue — lanza excepción para saltar iteración del for
    public function visitContinueStmt($ctx) { throw new ContinueException(); }

    // Sentencia return — lanza excepción con el valor de retorno
    public function visitReturnStmt($ctx) {
        if ($ctx->expList()) {
            $values = [];
            foreach ($ctx->expList()->expression() as $exp) { $values[] = $this->visit($exp); }
            if (count($values) === 1) {
                $this->dbg("returnStmt → " . $this->dumpVal($values[0]));
                throw new ReturnException($values[0]);
            }
            throw new ReturnException($values);
        }
        throw new ReturnException(null);
    }

    // ARREGLOS
    // Crea un arreglo multidimensional con valores por defecto
    private function createArray($dimensions, $defaultValue) {
        if (count($dimensions) === 0) return $defaultValue;
        $size = array_shift($dimensions); $array = [];
        for ($i = 0; $i < $size; $i++) $array[] = $this->createArray($dimensions, $defaultValue);
        return $array;
    }

    // Retorna el valor por defecto según el tipo base
    private function getDefaultValue($type) {
        switch ($type) {
            case "int": return 0; case "float": return 0.0; case "bool": return false;
            case "string": return ""; case "rune": return 0; default: return 0;
        }
    }

    // Literal de arreglo: [5]int{1, 2, 3, 4, 5}
    public function visitArrayLiteral($ctx) {
        $result = $this->visit($ctx->arrayElements());
        $this->dbg("visitArrayLiteral → " . $this->dumpVal($result));
        return $result;
    }

    // Elementos del literal de arreglo
    public function visitArrayElements($ctx) {
        $values = [];
        foreach ($ctx->arrayElement() as $element) {
            if ($element->expression()) $values[] = $this->visit($element->expression());
            else $values[] = $this->visit($element->arrayElements());
        }
        return $values;
    }

    // ACCESO A ARREGLOS — auto-desreferencia si es puntero a arreglo
    // Acceso a arreglo: a[i] — con auto-desreferencia si es puntero
    public function visitArrayAccess($ctx) {

        $name = $ctx->IDENTIFIER()->getText();

        try {
            $raw = $this->env->get($name);
        } catch (Exception $e) {
            $this->semanticError($e->getMessage(), $ctx);
            return null;
        }

        $isPointer = ($raw instanceof PointerValue);
        $array     = $isPointer ? $raw->getValue() : $raw;

        foreach ($ctx->arrayIndex() as $indexCtx) {
            $index = $this->visit($indexCtx->expression());
            if (!is_int($index)) { $this->semanticError("Índice debe ser int", $ctx); return null; }
            if (!is_array($array) || $index < 0 || $index >= count($array)) {
                $this->semanticError("Índice fuera de rango [$index] en '$name'", $ctx);
                return null;
            }
            $array = $array[$index];
        }

        return $array;
    }
}

class BreakException    extends Exception {}
class ContinueException extends Exception {}

class ReturnException extends Exception {
    public $value;
    public function __construct($value) { $this->value = $value; parent::__construct(); }
}