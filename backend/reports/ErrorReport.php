<?php

class ErrorReport {

    private static $instance = null;
    private $errors = [];

    private function __construct() {}

    // Singleton
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new ErrorReport();
        }
        return self::$instance;
    }

    // Agregar error
    public function add($type, $message, $line = null, $column = null) {
        $this->errors[] = [
            "type" => $type,
            "message" => $message,
            "line" => $line,
            "column" => $column
        ];

        // Mostrar en la consola del servidor
        error_log("[$type] $message (L:$line C:$column)");
    }

    // Obtener todos
    public function getErrors() {
        return $this->errors;
    }

    // Saber si hay errores
    public function hasErrors() {
        return count($this->errors) > 0;
    }

    // Limpiar
    public function clear() {
        $this->errors = [];
    }
}
