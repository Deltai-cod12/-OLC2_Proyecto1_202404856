<?php

namespace interpreterarm;

/**
 * Entrada en la tabla de símbolos del compilador ARM64.
 */
class ArmSymbol
{
    public string $name;
    public string $type;       // int32, float32, bool, string, rune, array, pointer, function
    public string $scope;      // global | nombre_función
    public int    $offset;     // offset en el stack frame (negativo respecto a x29)
    public int    $size;       // tamaño en bytes
    public int    $line;
    public int    $column;
    public bool   $isConst;
    public bool   $isParam;
    public string $value;      // valor estático si es constante
    // Para arreglos
    public array  $dimensions = [];
    public string $baseType   = '';
    // Para punteros
    public string $pointsTo   = '';
    // Para funciones
    public array  $paramTypes  = [];
    public array  $returnTypes = [];

    public function __construct(
        string $name,
        string $type,
        string $scope,
        int $offset,
        int $size,
        int $line,
        int $column,
        bool $isConst = false,
        bool $isParam = false,
        string $value = ''
    ) {
        $this->name    = $name;
        $this->type    = $type;
        $this->scope   = $scope;
        $this->offset  = $offset;
        $this->size    = $size;
        $this->line    = $line;
        $this->column  = $column;
        $this->isConst = $isConst;
        $this->isParam = $isParam;
        $this->value   = $value;
    }
}

/**
 * Tabla de símbolos para el compilador ARM64.
 * Maneja ámbitos anidados (global + funciones).
 */
class ArmSymbolTable
{
    /** @var array<string, ArmSymbol> */
    private array $globalScope = [];

    /** @var array<string, array<string, ArmSymbol>> función -> símbolos locales */
    private array $functionScopes = [];

    /** Función actualmente en procesamiento */
    private string $currentFunction = '';

    /** Offset actual del stack en la función activa (crece hacia negativo) */
    private int $currentOffset = 0;

    /** @var array<string, int> tamaño total del frame por función */
    private array $frameSizes = [];

    // ─── Gestión de ámbito ────────────────────────────────────────────────

    public function enterFunction(string $name): void
    {
        $this->currentFunction = $name;
        $this->currentOffset   = 0;
        if (!isset($this->functionScopes[$name])) {
            $this->functionScopes[$name] = [];
        }
    }

    public function exitFunction(): void
    {
        // Guardamos el tamaño total del frame (alineado a 16)
        $size = -$this->currentOffset;
        // Añadir 16 bytes para x29/x30
        $size += 16;
        // Alinear a 16
        if ($size % 16 !== 0) {
            $size = (intdiv($size, 16) + 1) * 16;
        }
        $this->frameSizes[$this->currentFunction] = $size;
        $this->currentFunction = '';
        $this->currentOffset   = 0;
    }

    public function getCurrentFunction(): string
    {
        return $this->currentFunction;
    }

    // ─── Registro de símbolos ─────────────────────────────────────────────

    /**
     * Declara una variable/parámetro en el ámbito actual.
     * Devuelve el símbolo creado.
     */
    public function declareLocal(
        string $name,
        string $type,
        int $size,
        int $line,
        int $column,
        bool $isConst = false,
        bool $isParam = false,
        string $value = ''
    ): ArmSymbol {
        $this->currentOffset -= $size;
        $sym = new ArmSymbol(
            $name, $type, $this->currentFunction,
            $this->currentOffset, $size,
            $line, $column, $isConst, $isParam, $value
        );
        $this->functionScopes[$this->currentFunction][$name] = $sym;
        return $sym;
    }

    public function declareGlobal(
        string $name,
        string $type,
        int $size,
        int $line,
        int $column,
        bool $isConst = false,
        string $value = ''
    ): ArmSymbol {
        $sym = new ArmSymbol(
            $name, $type, 'global',
            0, $size,
            $line, $column, $isConst, false, $value
        );
        $this->globalScope[$name] = $sym;
        return $sym;
    }

    public function declareFunction(
        string $name,
        array $paramTypes,
        array $returnTypes,
        int $line,
        int $column
    ): ArmSymbol {
        $sym = new ArmSymbol($name, 'function', 'global', 0, 0, $line, $column);
        $sym->paramTypes  = $paramTypes;
        $sym->returnTypes = $returnTypes;
        $this->globalScope[$name] = $sym;
        return $sym;
    }

    // ─── Búsqueda ─────────────────────────────────────────────────────────

    public function lookup(string $name): ?ArmSymbol
    {
        // Primero en el ámbito de la función actual
        if ($this->currentFunction !== '') {
            if (isset($this->functionScopes[$this->currentFunction][$name])) {
                return $this->functionScopes[$this->currentFunction][$name];
            }
        }
        // Luego global
        return $this->globalScope[$name] ?? null;
    }

    public function lookupGlobal(string $name): ?ArmSymbol
    {
        return $this->globalScope[$name] ?? null;
    }

    public function existsInCurrentScope(string $name): bool
    {
        if ($this->currentFunction !== '') {
            return isset($this->functionScopes[$this->currentFunction][$name]);
        }
        return isset($this->globalScope[$name]);
    }

    // ─── Offsets y frames ─────────────────────────────────────────────────

    public function getFrameSize(string $funcName): int
    {
        return $this->frameSizes[$funcName] ?? 32;
    }

    public function getCurrentOffset(): int
    {
        return $this->currentOffset;
    }

    public function reserveSpace(int $bytes): int
    {
        $this->currentOffset -= $bytes;
        return $this->currentOffset;
    }

    // ─── Para reportes ────────────────────────────────────────────────────

    public function getAllSymbols(): array
    {
        $all = [];
        foreach ($this->globalScope as $sym) {
            $all[] = $sym;
        }
        foreach ($this->functionScopes as $scope) {
            foreach ($scope as $sym) {
                $all[] = $sym;
            }
        }
        return $all;
    }

    // ─── Utilidades de tipo ───────────────────────────────────────────────

    public static function sizeOf(string $type): int
    {
        return match (true) {
            in_array($type, ['int32', 'int', 'float32', 'bool', 'rune']) => 8,
            $type === 'string' => 8,   // puntero a string en heap
            str_starts_with($type, '*') => 8,
            default => 8,
        };
    }

    public static function normalizeType(string $type): string
    {
        return match ($type) {
            'int', 'int32' => 'int32',
            'float', 'float32' => 'float32',
            'bool'   => 'bool',
            'string' => 'string',
            'rune'   => 'rune',
            default  => $type,
        };
    }
}