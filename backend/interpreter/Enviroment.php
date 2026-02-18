<?php

class Environment {

    private $values = [];
    private $constants = [];
    private $parent;

    public function __construct($parent = null) {
        $this->parent = $parent;
    }

    // =============================
    // DEFINIR VARIABLE
    // =============================
    public function define($name, $value) {

        if (array_key_exists($name, $this->values)) {
            throw new Exception("Variable '$name' ya definida en este ámbito");
        }

        $this->values[$name] = $value;
        $this->constants[$name] = false;
    }

    // =============================
    // DEFINIR CONSTANTE
    // =============================
    public function defineConst($name, $value) {

        if (array_key_exists($name, $this->values)) {
            throw new Exception("Identificador '$name' ya definido en este ámbito");
        }

        $this->values[$name] = $value;
        $this->constants[$name] = true;
    }

    // =============================
    // ASIGNAR
    // =============================
    public function assign($name, $value) {

        if (array_key_exists($name, $this->values)) {

            if ($this->constants[$name]) {
                throw new Exception("No se puede modificar la constante '$name'");
            }

            $this->values[$name] = $value;
            return;
        }

        if ($this->parent != null) {
            $this->parent->assign($name, $value);
            return;
        }

        throw new Exception("Variable '$name' no definida");
    }

    // =============================
    // OBTENER
    // =============================
    public function get($name) {

        if (array_key_exists($name, $this->values)) {
            return $this->values[$name];
        }

        if ($this->parent != null) {
            return $this->parent->get($name);
        }

        throw new Exception("Variable '$name' no definida");
    }

    public function getAll() {
        return $this->values;
    }
}
