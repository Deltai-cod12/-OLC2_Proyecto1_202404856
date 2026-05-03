<?php

namespace reportsarm;

class SymbolTableReport
{
    private array $symbols = [];

    public function addSymbol(
        string $identifier,
        string $type,
        string $scope,
        string $value,
        int $line,
        int $column
    ): void {
        $this->symbols[] = [
            'identifier' => $identifier,
            'type'       => $type,
            'scope'      => $scope,
            'value'      => $value,
            'line'       => $line,
            'column'     => $column,
        ];
    }

    public function getSymbols(): array
    {
        return $this->symbols;
    }

    public function toHTML(): string
    {
        if (empty($this->symbols)) {
            return '<p>Tabla de símbolos vacía.</p>';
        }

        $html = '<table border="1" cellpadding="6" cellspacing="0" style="border-collapse:collapse;width:100%;">';
        $html .= '<thead><tr>
            <th>Identificador</th>
            <th>Tipo</th>
            <th>Ámbito</th>
            <th>Valor</th>
            <th>Línea</th>
            <th>Columna</th>
        </tr></thead><tbody>';

        foreach ($this->symbols as $sym) {
            $html .= sprintf(
                '<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%d</td><td>%d</td></tr>',
                htmlspecialchars($sym['identifier']),
                htmlspecialchars($sym['type']),
                htmlspecialchars($sym['scope']),
                htmlspecialchars($sym['value']),
                $sym['line'],
                $sym['column']
            );
        }

        $html .= '</tbody></table>';
        return $html;
    }

    public function toArray(): array
    {
        return $this->symbols;
    }
}