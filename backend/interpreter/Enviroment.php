<?php

class Environment {

    private $values = [];
    private $parent;

    public function __construct($parent = null) {
        $this->parent = $parent;
    }

    // Declarar variable
    public function define($name, $value) {
        $this->values[$name] = $value;
    }

    // Asignar (busca en scopes superiores)
    public function assign($name, $value) {

        if (array_key_exists($name, $this->values)) {
            $this->values[$name] = $value;
            return;
        }

        if ($this->parent != null) {
            $this->parent->assign($name, $value);
            return;
        }

        // En esta versión estable no lanzamos error
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

    public function getAll() {
        return $this->values;
    }
}
