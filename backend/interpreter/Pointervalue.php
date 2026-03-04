<?php

/**
 * PointerValue
 * 
 * Representa un puntero en el lenguaje Golampi.
 * En lugar de almacenar una dirección de memoria real, guarda una referencia
 * al Environment que contiene la variable y el nombre de la misma.
 * 
 * Esto permite implementar la semántica de paso por referencia:
 *   &x   → crea PointerValue($env, 'x')
 *   *ptr → llama a $ptr->getValue()
 *   *ptr = v → llama a $ptr->setValue(v)
 */
class PointerValue {

    /** @var Environment El entorno donde vive la variable apuntada */
    public $env;

    /** @var string Nombre de la variable apuntada */
    public $name;

    public function __construct(Environment $env, string $name) {
        $this->env  = $env;
        $this->name = $name;
    }

    /**
     * Leer el valor apuntado.
     * Equivalente a desreferenciar: *ptr
     */
    public function getValue() {
        return $this->env->get($this->name);
    }

    /**
     * Escribir un valor en la variable apuntada.
     * Equivalente a: *ptr = value
     * Modifica directamente la variable en su entorno original.
     */
    public function setValue($value): void {
        $this->env->assign($this->name, $value);
    }

    /**
     * Representación textual (útil para depuración)
     */
    public function __toString(): string {
        return "pointer(&{$this->name})";
    }
}