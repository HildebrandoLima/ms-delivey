<?php

namespace App\Dtos;

use App\Support\Traits\DefaultFields;

class AddressDto 
{
    use DefaultFields;
    public int $enderecoId = 0;
    public string $logradouro = "";
    public int $numero = 0;
    public string $bairro = "";
    public string $cidade = "";
    public string $cep = "";
    public string $uf = "";
    public int|null $usuarioId = 0;
    public int|null $fornecedorId = 0;
}
