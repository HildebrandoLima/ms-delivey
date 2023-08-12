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

    public function setUsuarioId(int $usuarioId): void
    {
        $this->usuarioId = $usuarioId;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): void
    {
        $this->cpf = $cpf;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getDataNascimento(): string
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(string $dataNascimento): void
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function getGenero(): string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): void
    {
        $this->genero = $genero;
    }

    public function getEmailVerificado(): bool
    {
        return $this->emailVerificado;
    }

    public function setEmailVerificado(bool $emailVerificado): void
    {
        $this->emailVerificado = $emailVerificado;
    }

    public function getEAdmin(): bool
    {
        return $this->eAdmin;
    }

    public function setEAdmin(bool $eAdmin): void
    {
        $this->eAdmin = $eAdmin;
    }

    public function getEnderecos(): array
    {
        return $this->enderecos;
    }

    public function setEnderecos(array $enderecos): void
    {
        $this->enderecos = EntityPerson::addrres($enderecos);
    }

    public function getTelefones(): array
    {
        return $this->telefones;
    }

    public function setTelefones(array $telefones): void
    {
        $this->telefones = EntityPerson::telephone($telefones);
    }
}
