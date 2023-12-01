<?php

namespace App\Dtos;

use App\Support\MapperEntity\EntityPerson;
use App\Support\Traits\DefaultFields;

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
    public ?bool $emailVerificado;
    public ?bool $eAdmin = false;
    public ?array $enderecos = [];
    public ?array $telefones = [];

    public function customizeMapping(array $data): void
    {
        $this->emailVerificado = $data['email_verified_at'] ?? false;
        $this->mapCommonFields($data);
        $this->enderecos = EntityPerson::addrres($data['endereco'] ?? []) ?? [];
        $this->telefones = EntityPerson::telephone($data['telefone'] ?? []) ?? [];
    }
}
