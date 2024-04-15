<?php

namespace App\Domains\Dtos;

use App\Support\Traits\DefaultFields;
use App\Support\Utils\MapperDtos\EntityPerson;

class ProviderDto
{
    use DefaultFields, EntityPerson;

    public string $razaoSocial = "";
    public string $cnpj = "";
    public string $email = "";
    public string $dataFundacao = "";
    public ?array $enderecos = [];
    public ?array $telefones = [];

    public function customizeMapping(array $data): void
    {
        $this->mapCommonFields($data);
        $this->enderecos = $this->address($data['endereco'] ?? []);
        $this->telefones = $this->telephone($data['telefone'] ?? []);
    }
}
