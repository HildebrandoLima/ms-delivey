<?php

namespace App\Dtos;

use App\Support\Traits\DefaultFields;

class ProviderDto 
{
    use DefaultFields;
    public int $fornecedorId = 0;
    public string $razaoSocial = "";
    public string $cnpj = "";
    public string $email = "";
    public string $dataFundacao = "";
    public array $enderecos = [];
    public array $telefones = [];
}
