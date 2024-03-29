<?php

namespace App\Domains\Dtos;

use App\Support\Traits\DefaultFields;
use App\Support\Utils\MapperDtos\EntityPerson;

class UserDto
{
    use DefaultFields;
    public ?int $loginSocialId = 0;
    public ?string $loginSocial = "";
    public string $nome = "";
    public ?string $cpf = "";
    public string $email = "";
    public ?string $dataNascimento = "";
    public string $genero = "";
    public ?bool $emailVerificado = false;
    public ?bool $eAdmin = false;
    public ?array $enderecos = [];
    public ?array $telefones = [];

    public function customizeMapping(array $data): void
    {
        $this->mapCommonFields($data);
        $this->enderecos = EntityPerson::addrres($data['endereco'] ?? []);
        $this->telefones = EntityPerson::telephone($data['telefone'] ?? []);
    }
}
