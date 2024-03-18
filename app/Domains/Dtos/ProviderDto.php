<?php

namespace App\Domains\Dtos;

use App\Support\Traits\DefaultFields;
use App\Support\Utils\MapperDtos\EntityPerson;

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
