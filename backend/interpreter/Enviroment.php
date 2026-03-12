<?php

require_once __DIR__ . '/Symbol.php';
require_once __DIR__ . '/SymbolTable.php';
require_once __DIR__ . '/Pointervalue.php';

class Environment {

    private $symbols   = [];   // Symbol objects — value es el valor PHP real
    private $parent;
    private $scopeLevel;
    private $scopeName;

    public function __construct($parent = null, $scopeName = null) {
        $this->parent     = $parent;
        $this->scopeLevel = ($parent === null) ? 0 : $parent->scopeLevel + 1;

        if ($scopeName !== null) {
            $this->scopeName = $scopeName;
        } else if ($parent === null) {
            $this->scopeName = "global";
        } else {
            // Bloques heredan el ámbito del padre (función, etc.)
            $this->scopeName = $parent->scopeName;
        }
    }

    public function getScopeName(): string {
        return $this->scopeName;
    }

    // DEFINIR VARIABLE
    public function define($name, $dataType, $value = null, $line = 0, $column = 0) {

        if (array_key_exists($name, $this->symbols)) {
            throw new Exception("Variable '$name' ya definida en este ámbito");
        }

        if ($value === null) {
            $value = $this->getDefaultValue($dataType);
        }

        if (!$this->checkType($dataType, $value)) {
            throw new Exception("Tipo incompatible para '$name'");
        }

        // Symbol guarda el valor PHP real — el formateo es responsabilidad de SymbolTable
        $symbol = new Symbol($name, $dataType, $value, $this->scopeName, $line, $column, false);
        $this->symbols[$name] = $symbol;

        // Registrar en la tabla global de símbolos
        SymbolTable::getInstance()->add($symbol);
    }

    // DEFINIR CONSTANTE
    public function defineConst($name, $dataType, $value, $line = 0, $column = 0) {

        if (array_key_exists($name, $this->symbols)) {
            throw new Exception("Identificador '$name' ya definido en este ámbito");
        }

        if (!$this->checkType($dataType, $value)) {
            throw new Exception("Tipo incompatible para constante '$name'");
        }

        $symbol = new Symbol($name, $dataType, $value, $this->scopeName, $line, $column, true);
        $this->symbols[$name] = $symbol;

        SymbolTable::getInstance()->add($symbol);
    }

    // ASIGNAR — actualiza el valor PHP real en Symbol value
    public function assign($name, $value) {

        if (array_key_exists($name, $this->symbols)) {

            $symbol = $this->symbols[$name];

            if ($symbol->isConst) {
                throw new Exception("No se puede modificar la constante '$name'");
            }

            if (!$this->checkType($symbol->type, $value)) {
                throw new Exception("Tipo incompatible en asignación a '$name'");
            }

            // Guardar el valor PHP real directamente
            $symbol->value = $value;
            return;
        }

        if ($this->parent !== null) {
            $this->parent->assign($name, $value);
            return;
        }

        throw new Exception("Variable '$name' no definida");
    }

    // OBTENER valor PHP real para cálculos
    public function get($name) {

        if (array_key_exists($name, $this->symbols)) {
            return $this->symbols[$name]->value;
        }

        if ($this->parent !== null) {
            return $this->parent->get($name);
        }

        throw new Exception("Variable '$name' no definida");
    }

    // OBTENER el entorno exacto donde vive la variable (para operador &)
    public function getEnvFor(string $name): Environment {

        if (array_key_exists($name, $this->symbols)) {
            return $this;
        }

        if ($this->parent !== null) {
            return $this->parent->getEnvFor($name);
        }

        throw new Exception("Variable '$name' no definida");
    }

    // OBTENER TIPO (para el Interpreter)
    public function getType($name) {

        if (array_key_exists($name, $this->symbols)) {
            return $this->symbols[$name]->type;
        }

        if ($this->parent !== null) {
            return $this->parent->getType($name);
        }

        throw new Exception("Variable '$name' no definida");
    }

    // HELPERS PRIVADOS

    private function getDefaultValue($type) {
        switch ($type) {
            case "int": case "int32": case "rune": return 0;
            case "float": case "float32":          return 0.0;
            case "bool":                           return false;
            case "string":                         return "";
            case "pointer":                        return null;
            default:                               return null;
        }
    }

    private function checkType($type, $value): bool {
        switch ($type) {
            case "int": case "int32": case "rune":
                return is_int($value);
            case "float": case "float32":
                return is_float($value) || is_int($value);
            case "bool":
                return is_bool($value);
            case "string":
                return is_string($value);
            case "pointer":
                return ($value instanceof PointerValue) || $value === null;
            default:
                // arrays, función y otros tipos: el Interpreter garantiza coherencia
                return true;
        }
    }
}