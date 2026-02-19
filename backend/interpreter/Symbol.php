<?php

class Symbol {

    public $id;
    public $type;
    public $value;
    public $scope;
    public $line;
    public $column;
    public $isConst;

    public function __construct($id, $type, $value, $scope, $line, $column, $isConst = false) {
        $this->id = $id;
        $this->type = $type;
        $this->value = $value;
        $this->scope = $scope;
        $this->line = $line;
        $this->column = $column;
        $this->isConst = $isConst;
    }
}
