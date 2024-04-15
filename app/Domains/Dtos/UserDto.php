<?php

namespace App\Domains\Dtos;

use App\Domains\Traits\Dtos\DefaultFields;
use App\Domains\Traits\Dtos\EntityPerson;

class UserDto
{
    use DefaultFields, EntityPerson;

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
        $this->enderecos = $this->address($data['endereco'] ?? []);
        $this->telefones = $this->telephone($data['telefone'] ?? []);
    }
}
