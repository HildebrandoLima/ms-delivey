<?php

namespace App\DataTransferObjects\Dtos;

use App\Support\MapperEntity\EntityPerson;

class UserDto extends DefaultFields
{
    public int $usuario_id;
    public int|null $login_social_id;
    public string|null $login_social;
    public string $name;
    public string|null $cpf;
    public string $email;
    public string|null $password;
    public string|null $data_nascimento;
    public string $genero;
    public bool $email_verificado;
    public bool $is_admin;
    public array $enderecos;
    public array $telefones;

    public static function construction(): static
    {
        return new UserDto();
    }

    public function getUsuarioId(): int
    {
        return $this->usuario_id;
    }

    public function setUsuarioId(int $usuario_id): UserDto
    {
        $this->usuario_id = $usuario_id;
        return $this;
    }

    public function getLoginSocialId(): int|null
    {
        return $this->login_social_id;
    }

    public function setLoginSocialId(int|null $login_social_id): UserDto
    {
        $this->login_social_id = $login_social_id;
        return $this;
    }

    public function getLoginSocial(): string|null
    {
        return $this->login_social;
    }

    public function setLoginSocial(string|null $login_social): UserDto
    {
        $this->login_social = $login_social;
        return $this;
    }

    public function getNome(): string
    {
        return $this->name;
    }

    public function setNome(string $name): UserDto
    {
        $this->name = $name;
        return $this;
    }

    public function getCpf(): string|null
    {
        return $this->cpf;
    }

    public function setCpf(string|null $cpf): UserDto
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

    public function setSenha(string|null $password): UserDto
    {
        $this->password = $password;
        return $this;
    }

    public function getSenha(): string|null
    {
        return $this->password;
    }

    public function getDataNascimento(): string|null
    {
        return $this->data_nascimento;
    }

    public function setDataNascimento(string|null $data_nascimento): UserDto
    {
        $this->data_nascimento = $data_nascimento;
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
        return $this->email_verificado;
    }

    public function setEmailVerificado(bool $email_verificado): UserDto
    {
        $this->email_verificado = $email_verificado;
        return $this;
    }

    public function getIsAdmin(): bool
    {
        return $this->is_admin;
    }

    public function setIsAdmin(bool $is_admin): UserDto
    {
        $this->is_admin = $is_admin;
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
