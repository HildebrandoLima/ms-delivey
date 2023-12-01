<?php

namespace App\Dtos;

use App\Support\Traits\DefaultFields;

class TelephoneDto
{
    use DefaultFields;
    public string $numero = "";
    public string $tipo = "";
    public ?int $usuarioId = 0;
    public ?int $fornecedorId = 0;

    public function customizeMapping(array $data): void
    {
        $this->usuarioId = $data['usuario_id'] ?? 0;
        $this->fornecedorId = $data['fornecedor_id'] ?? 0;
        $this->mapCommonFields($data);
    }
}
