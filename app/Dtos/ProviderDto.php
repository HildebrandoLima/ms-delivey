<?php

namespace App\Dtos;

use App\Support\MapperEntity\EntityPerson;
use App\Support\Traits\DefaultFields;

class ProviderDto
{
    use DefaultFields;
    public string $razaoSocial = "";
    public string $cnpj = "";
    public string $email = "";
    public string $dataFundacao = "";
    public ?array $enderecos = [];
    public ?array $telefones = [];

    public function customizeMapping(array $data): void
    {
        $this->mapCommonFields($data);
        $this->enderecos = EntityPerson::addrres($data['endereco'] ?? []);
        $this->telefones = EntityPerson::telephone($data['telefone'] ?? []);
    }
}
