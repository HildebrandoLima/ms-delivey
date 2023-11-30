<?php

namespace App\Dtos;

use App\Support\Traits\DefaultFields;

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
        $this->usuarioId = $data['usuario_id'] ?? 0;
        $this->fornecedorId = $data['fornecedor_id'] ?? 0;
        $this->mapCommonFields($data);
    }
}
