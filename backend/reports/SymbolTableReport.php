<?php

class SymbolTableReport {

    public static function generate($symbols) {
        return json_encode($symbols, JSON_PRETTY_PRINT);
    }
}
