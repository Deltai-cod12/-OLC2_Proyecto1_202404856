<?php

/**
 * SymbolTable — Singleton
 * Recolecta todos los Symbol declarados durante la ejecución.
 * El formateo de valores ocurre aquí, en toArray(), no en Environment.
 */
class SymbolTable {

    private static $instance = null;
    private $symbols = [];

    private function __construct() {}

    public static function getInstance(): SymbolTable {
        if (self::$instance === null) {
            self::$instance = new SymbolTable();
        }
        return self::$instance;
    }

    // Agregar un Symbol (se guarda referencia, por lo que el value se lee al exportar)
    public function add(Symbol $symbol): void {
        $this->symbols[] = $symbol;
    }

    // Limpiar antes de cada ejecución
    public function clear(): void {
        $this->symbols = [];
    }

    // Serializar para el frontend — formatea valores aquí
    public function toArray(): array {
        $result = [];
        foreach ($this->symbols as $symbol) {
            $result[] = [
                "identificador" => $symbol->id,
                "tipo"          => $this->formatType($symbol->type),
                "ambito"        => $symbol->scope,
                "valor"         => $this->formatValue($symbol->value),
                "linea"         => $symbol->line,
                "columna"       => $symbol->column
            ];
        }
        return $result;
    }

    // Formatea el tipo interno al nombre legible
    private function formatType(string $type): string {
        switch ($type) {
            case "int":     return "entero";
            case "float":   return "flotante";
            case "bool":    return "booleano";
            case "string":  return "cadena";
            case "rune":    return "rune";
            case "array":   return "arreglo";
            case "pointer": return "puntero";
            case "función": return "función";
            case "nil":     return "nil";
            default:        return $type;
        }
    }

    // Formatea el valor PHP al string legible para la tabla
    private function formatValue($value): string {
        if ($value === null)                  return "—";
        if (is_bool($value))                  return $value ? "true" : "false";
        if ($value instanceof PointerValue)   return "&{$value->name}";
        if (is_array($value))                 return "{" . implode(",", array_map([$this, 'formatValue'], $value)) . "}";
        if (is_string($value))                return "\"$value\"";
        return (string)$value;
    }
}