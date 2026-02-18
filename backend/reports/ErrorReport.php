<?php

class ErrorReport {

    private $errors = [];

    public function add($error) {
        $this->errors[] = $error;
    }

    public function getErrors() {
        return $this->errors;
    }
}
