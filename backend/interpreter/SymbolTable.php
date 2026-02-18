<?php

class SymbolTable {

    private $symbols = [];

    public function add($name, $value) {
        $this->symbols[$name] = $value;
    }

    public function getAll() {
        return $this->symbols;
    }
}
