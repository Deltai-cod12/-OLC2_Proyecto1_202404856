<?php

namespace interpreterarm;

/**
 * FrameManager — Administrador del stack frame ARM64 (AArch64) con prólogo diferido.
 *
 * DISEÑO:
 *   El layout del frame es el siguiente (crece hacia arriba desde x29):
 *
 *   [x29, #0]   x29 (saved frame pointer) y x30 (link register) — guardados por stp
 *   [x29, #16]  primera variable local (o primer parámetro)
 *   [x29, #24]  segunda variable local
 *   [x29, #32]  ...
 */
class FrameManager
{
    /**
     * Offset del siguiente slot disponible, relativo a x29.
     * Empieza en 16 porque los bytes [0..15] los ocupa stp x29,x30.
     */
    private int $nextOffset = 16;

    /**
     * Nombre de la función actual (solo para mensajes de depuración).
     */
    private string $funcName = '';

    /**
     * Mapa nombre → ArmSymbol para las variables del frame actual.
     * Permite buscar rápido sin consultar la tabla de símbolos completa.
     *
     * @var array<string, ArmSymbol>
     */
    private array $locals = [];

    // ──────────────────────────────────────────────────────────────────────
    //  CICLO DE VIDA
    // ──────────────────────────────────────────────────────────────────────

    /**
     * Inicia un nuevo frame para la función $name.
     * Reinicia todos los contadores.
     */
    public function enter(string $name): void
    {
        $this->funcName   = $name;
        $this->nextOffset = 16;   // reservar espacio para x29/x30
        $this->locals     = [];
    }

    /**
     * Cierra el frame y devuelve el tamaño final (alineado a 16 bytes).
     * Este valor es el que se pone en `stp x29, x30, [sp, #-SIZE]!`.
     *
     * El mínimo es 16 (solo x29+x30). Si hay variables, se suma su espacio.
     */
    public function leave(): int
    {
        return $this->getFrameSize();
    }

    // ──────────────────────────────────────────────────────────────────────
    //  ASIGNACIÓN DE SLOTS
    // ──────────────────────────────────────────────────────────────────────

    /**
     * Reserva $bytes bytes en el frame y devuelve el offset (positivo, relativo a x29).
     *
     * Todos los slots se alinean a 8 bytes (tamaño de un registro en AArch64).
     * Bloques más grandes (arreglos) se alinean a 16 bytes.
     */
    public function allocate(int $bytes): int
    {
        // Alinear el tamaño al múltiplo de 8 más cercano
        $bytes = $this->alignTo($bytes, 8);

        $offset           = $this->nextOffset;
        $this->nextOffset += $bytes;

        return $offset;
    }

    /**
     * Registra un símbolo en el frame con el offset calculado.
     * Si el símbolo ya tiene offset asignado, lo respeta.
     */
    public function registerSymbol(ArmSymbol $sym, int $bytes = 8): void
    {
        if (!isset($this->locals[$sym->name])) {
            $sym->offset              = $this->allocate($bytes);
            $this->locals[$sym->name] = $sym;
        }
    }

    /**
     * Reserva espacio sin asociarlo a ningún símbolo (ej. scratch slot).
     * Devuelve el offset.
     */
    public function reserveSlot(int $bytes = 8): int
    {
        return $this->allocate($bytes);
    }

    // ──────────────────────────────────────────────────────────────────────
    //  CONSULTAS
    // ──────────────────────────────────────────────────────────────────────

    /**
     * Devuelve el tamaño del frame alineado a 16 bytes.
     * Este es el valor definitivo para el prólogo/epílogo.
     */
    public function getFrameSize(): int
    {
        // Asegurarse de que el frame tenga al menos 16 bytes (para x29/x30)
        $raw = max($this->nextOffset, 16);
        // Alinear a 16 bytes (requisito AAPCS64)
        return $this->alignTo($raw, 16);
    }

    /**
     * Devuelve el offset actual (cuántos bytes se han asignado ya).
     */
    public function getCurrentOffset(): int
    {
        return $this->nextOffset;
    }

    /**
     * Devuelve el nombre de la función asociada a este frame.
     */
    public function getFuncName(): string
    {
        return $this->funcName;
    }

    // ──────────────────────────────────────────────────────────────────────
    //  UTILIDADES
    // ──────────────────────────────────────────────────────────────────────

    /**
     * Redondea $value al múltiplo de $alignment más cercano (hacia arriba).
     */
    private function alignTo(int $value, int $alignment): int
    {
        return (int)(ceil($value / $alignment) * $alignment);
    }
}