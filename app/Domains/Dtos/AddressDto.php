<?php

namespace App\Domains\Dtos;

use App\Domains\Traits\Dtos\DefaultFields;

class AddressDto
{
    use DefaultFields;

    public string $logradouro = "";
    public int $numero = 0;
    public string $bairro = "";
    public string $cidade = "";
    public string $cep = "";
    public string $uf = "";
    public ?int $usuarioId = 0;
    public ?int $fornecedorId = 0;

    public function customizeMapping(array $data): void
    {
        $this->mapCommonFields($data);
    }
}
