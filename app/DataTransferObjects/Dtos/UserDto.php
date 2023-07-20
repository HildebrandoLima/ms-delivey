<?php

namespace App\DataTransferObjects\Dtos;

use App\Support\MapperEntity\EntityPerson;

class UserDto extends DefaultFields
{
    public int $usuarioId;
    public int $loginSocialId;
    public string $loginSocial;
    public string $nome;
    public string $cpf;
    public string $email;
    public string $dataNascimento;
    public string $genero;
    public bool $emailVerificado;
    public bool $isAdmin;
    public array $enderecos;
    public array $telefones;

    public static function construction(): static
    {
        return new UserDto();
    }

    public function getUsuarioId(): int
    {
        return $this->usuarioId;
    }

    public function setUsuarioId(int $usuarioId): UserDto
    {
        $this->usuarioId = $usuarioId;
        return $this;
    }

    public function getLoginSocialId(): int
    {
        return $this->loginSocialId;
    }

    public function setLoginSocialId(int $loginSocialId): UserDto
    {
        $this->loginSocialId = $loginSocialId;
        return $this;
    }

    public function getLoginSocial(): string
    {
        return $this->loginSocial;
    }

    public function setLoginSocial(string $loginSocial): UserDto
    {
        $this->loginSocial = $loginSocial;
        return $this;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): UserDto
    {
        $this->nome = $nome;
        return $this;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): UserDto
    {
        $this->cpf = $cpf;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): UserDto
    {
        $this->email = $email;
        return $this;
    }

    public function getDataNascimento(): string
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(string $dataNascimento): UserDto
    {
        $this->dataNascimento = $dataNascimento;
        return $this;
    }

    public function getGenero(): string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): UserDto
    {
        $this->genero = $genero;
        return $this;
    }

    public function getEmailVerificado(): bool
    {
        return $this->emailVerificado;
    }

    public function setEmailVerificado(bool $emailVerificado): UserDto
    {
        $this->emailVerificado = $emailVerificado;
        return $this;
    }

    public function getIsAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): UserDto
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }

    public function getEnderecos(): array
    {
        return $this->enderecos;
    }

    public function setEnderecos(array $enderecos): UserDto
    {
        $this->enderecos = EntityPerson::addrres($enderecos);
        return $this;
    }

    public function getTelefones(): array
    {
        return $this->telefones;
    }

    public function setTelefones(array $telefones): UserDto
    {
        $this->telefones = EntityPerson::telephone($telefones);
        return $this;
    }
}
