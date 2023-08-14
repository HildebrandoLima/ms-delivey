<?php

namespace App\Dtos;

use App\Support\Traits\DefaultFields;

class UserDto 
{
    use DefaultFields;
    public int $usuarioId = 0;
    public int|null $loginSocialId = 0;
    public string|null $loginSocial = "";
    public string $nome = "";
    public string|null $cpf = "";
    public string $email = "";
    public string|null $dataNascimento = "";
    public string $genero = "";
    public bool|null $emailVerificado;
    public bool $eAdmin;
    public array $enderecos = [];
    public array $telefones = [];
}
