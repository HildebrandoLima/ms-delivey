<?php

namespace App\Domains\Dtos;

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
        $this->mapCommonFields($data);
    }
}
