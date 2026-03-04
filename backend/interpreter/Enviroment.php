<?php

require_once __DIR__ . '/Symbol.php';
require_once __DIR__ . '/Pointervalue.php';   // ← NUEVO: necesario para checkType

class Environment {

    private $symbols = [];
    private $parent;
    private $scopeLevel;

    public function __construct($parent = null) {
        $this->parent     = $parent;
        $this->scopeLevel = ($parent == null) ? 0 : $parent->scopeLevel + 1;
    }

    
    // DEFINIR VARIABLE
    public function define($name, $dataType, $value = null, $line = 0, $column = 0) {

        if (array_key_exists($name, $this->symbols)) {
            throw new Exception("Variable '$name' ya definida en este ámbito");
        }

        // Valor por defecto según tipo
        if ($value === null) {
            $value = $this->getDefaultValue($dataType);
        }

        // Verificar compatibilidad
        if (!$this->checkType($dataType, $value)) {
            throw new Exception("Tipo incompatible para '$name'");
        }

        $this->symbols[$name] = new Symbol(
            $name,
            $dataType,
            $value,
            $this->scopeLevel,
            $line,
            $column,
            false
        );
    }

    // DEFINIR CONSTANTE
    public function defineConst($name, $dataType, $value, $line = 0, $column = 0) {

        if (array_key_exists($name, $this->symbols)) {
            throw new Exception("Identificador '$name' ya definido en este ámbito");
        }

        if (!$this->checkType($dataType, $value)) {
            throw new Exception("Tipo incompatible para constante '$name'");
        }

        $this->symbols[$name] = new Symbol(
            $name,
            $dataType,
            $value,
            $this->scopeLevel,
            $line,
            $column,
            true
        );
    }

    
    // ASIGNAR
    public function assign($name, $value) {

        if (array_key_exists($name, $this->symbols)) {

            $symbol = $this->symbols[$name];

            if ($symbol->isConst) {
                throw new Exception("No se puede modificar la constante '$name'");
            }

            // Validar tipo
            if (!$this->checkType($symbol->type, $value)) {
                throw new Exception("Tipo incompatible en asignación a '$name'");
            }

            $symbol->value = $value;
            return;
        }

        if ($this->parent != null) {
            $this->parent->assign($name, $value);
            return;
        }

        throw new Exception("Variable '$name' no definida");
    }

    
    // OBTENER valor
    public function get($name) {

        if (array_key_exists($name, $this->symbols)) {
            return $this->symbols[$name]->value;
        }

        if ($this->parent != null) {
            return $this->parent->get($name);
        }

        throw new Exception("Variable '$name' no definida");
    }

    
    // =====================================================================
    // NUEVO: OBTENER EL ENTORNO EXACTO donde vive la variable
    // Usado por el operador & para construir un PointerValue correcto.
    // =====================================================================
    public function getEnvFor(string $name): Environment {

        if (array_key_exists($name, $this->symbols)) {
            return $this;
        }

        if ($this->parent !== null) {
            return $this->parent->getEnvFor($name);
        }

        throw new Exception("Variable '$name' no definida");
    }


    // VALORES POR DEFECTO
    private function getDefaultValue($type) {

        switch ($type) {
            case "int":
            case "int32":
            case "rune":
                return 0;

            case "float":
            case "float32":
                return 0.0;

            case "bool":
                return false;

            case "string":
                return "";

            // ← NUEVO: punteros inician en nil (null)
            case "pointer":
                return null;

            default:
                return null;
        }
    }

    
    // VERIFICACIÓN DE TIPOS
    private function checkType($type, $value) {

        switch ($type) {

            case "int":
            case "int32":
            case "rune":
                return is_int($value);

            case "float":
            case "float32":
                return is_float($value) || is_int($value);

            case "bool":
                return is_bool($value);

            case "string":
                return is_string($value);

            // ← NUEVO: los punteros aceptan PointerValue o null (nil)
            case "pointer":
                return ($value instanceof PointerValue) || $value === null;

            default:
                // arrays y otros tipos compuestos: el Interpreter garantiza la coherencia
                return true;
        }
    }

    
    // TABLA DE SÍMBOLOS (REPORTE)
    public function getAll() {

        $result = [];

        foreach ($this->symbols as $symbol) {
            $result[] = [
                "id"      => $symbol->id,
                "tipo"    => $symbol->type,
                "ambito"  => $symbol->scope,
                "valor"   => $symbol->value,
                "linea"   => $symbol->line,
                "columna" => $symbol->column
            ];
        }

        if ($this->parent != null) {
            $result = array_merge($this->parent->getAll(), $result);
        }

        return $result;
    }

    
    // OBTENER TIPO (para el Interpreter)
    public function getType($name) {

        if (array_key_exists($name, $this->symbols)) {
            return $this->symbols[$name]->type;
        }

        if ($this->parent != null) {
            return $this->parent->getType($name);
        }

        throw new Exception("Variable '$name' no definida");
    }
}