<?php

// Clase que representa un puntero en Golampi
// En lugar de guardar una dirección de memoria real,
// guardo el entorno donde está la variable y su nombre.
class PointerValue {

    // Entorno donde existe la variable apuntada
    public $env;

    // Nombre de la variable a la que apunta
    public $name;

    public function __construct(Environment $env, string $name) {
        $this->env  = $env;
        $this->name = $name;
    }

    // Obtener el valor de la variable apuntada
    // Equivalente a usar *ptr en el lenguaje
    public function getValue() {
        return $this->env->get($this->name);
    }

    // Cambiar el valor de la variable apuntada
    // Equivalente a: *ptr = valor
    // Modifica directamente la variable original
    public function setValue($value): void {
        $this->env->assign($this->name, $value);
    }

    // Representación en texto del puntero (útil para depuración)
    public function __toString(): string {
        return "pointer(&{$this->name})";
    }
}