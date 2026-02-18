<?php

class Environment {

    private $values = [];
    private $parent;

    public function __construct($parent = null) {
        $this->parent = $parent;
    }

    // Declarar variable (scope actual)
    public function define($name, $value) {

        if (array_key_exists($name, $this->values)) {
            throw new Exception("Variable '$name' ya declarada en este ámbito");
        }

        $this->values[$name] = $value;
    }

    // Asignar variable (busca en scopes)
    public function assign($name, $value) {

        if (array_key_exists($name, $this->values)) {
            $this->values[$name] = $value;
            return;
        }

        if ($this->parent != null) {
            $this->parent->assign($name, $value);
            return;
        }

        throw new Exception("Variable '$name' no definida");
    }

    // Obtener valor
    public function get($name) {

        if (array_key_exists($name, $this->values)) {
            return $this->values[$name];
        }

        if ($this->parent != null) {
            return $this->parent->get($name);
        }

        throw new Exception("Variable '$name' no definida");
    }

    // Reporte
    public function getAll() {
        return $this->values;
    }
}
