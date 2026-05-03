<?php

namespace reportsarm;

class ErrorReport
{
    private array $errors = [];

    public function addError(string $type, string $description, int $line, int $column): void
    {
        $this->errors[] = [
            'type'        => $type,
            'description' => $description,
            'line'        => $line,
            'column'      => $column,
        ];
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    public function toHTML(): string
    {
        if (empty($this->errors)) {
            return '<p>No se encontraron errores.</p>';
        }

        $html = '<table border="1" cellpadding="6" cellspacing="0" style="border-collapse:collapse;width:100%;">';
        $html .= '<thead><tr>
            <th>#</th>
            <th>Tipo</th>
            <th>Descripción</th>
            <th>Línea</th>
            <th>Columna</th>
        </tr></thead><tbody>';

        foreach ($this->errors as $i => $err) {
            $html .= sprintf(
                '<tr><td>%d</td><td>%s</td><td>%s</td><td>%d</td><td>%d</td></tr>',
                $i + 1,
                htmlspecialchars($err['type']),
                htmlspecialchars($err['description']),
                $err['line'],
                $err['column']
            );
        }

        $html .= '</tbody></table>';
        return $html;
    }

    public function toArray(): array
    {
        return $this->errors;
    }
}