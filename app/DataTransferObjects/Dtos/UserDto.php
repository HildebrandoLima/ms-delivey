<?php

namespace App\DataTransferObjects\Dtos;

use App\Support\MapperEntity\EntityPerson;

class UserDto extends DefaultFields
{
    public int $usuarioId;
    public string $nome;
    public string $cpf;
    public string $email;
    public string $dataNascimento;
    public string $genero;
    public bool $emailVerificado;
    public bool $eAdmin;
    public array $enderecos;
    public array $telefones;

    public function __construct
    (
        int $usuarioId,
        string $nome,
        string $cpf,
        string $email,
        string $dataNascimento,
        string $genero,
        bool $emailVerificado,
        bool $eAdmin,
        array $enderecos,
        array $telefones,
        string $ativo,
        string $criadoEm,
        string $aleradoEm
    )
    {
        $this->setUsuarioId($usuarioId);
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setEmail($email);
        $this->setDataNascimento($dataNascimento);
        $this->setGenero($genero);
        $this->setEmailVerificado($emailVerificado);
        $this->setEAdmin($eAdmin);
        $this->setEnderecos($enderecos);
        $this->setTelefones($telefones);
        $this->setAtivo($ativo);
        $this->setCriadoEm($criadoEm);
        $this->setAlteradoEm($aleradoEm);
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

    public function getEAdmin(): bool
    {
        return $this->eAdmin;
    }

    public function setEAdmin(bool $eAdmin): UserDto
    {
        $this->eAdmin = $eAdmin;
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
