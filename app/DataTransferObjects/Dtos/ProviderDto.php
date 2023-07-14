<?php

namespace App\DataTransferObjects\Dtos;

use App\Support\MapperEntity\EntityPerson;

class ProviderDto extends DefaultFields
{
    public int $fornecedorId;
    public string $razaoSocial;
    public string $cnpj;
    public string $email;
    public string $dataFundacao;
    public array $enderecos;
    public array $telefones;

    public static function construction(): static
    {
        return new ProviderDto();
    }

    public function getFornecedorId(): int
    {
        return $this->fornecedorId;
    }

    public function setFornecedorId(int $fornecedorId): ProviderDto
    {
        $this->fornecedorId = $fornecedorId;
        return $this;
    }

    public function getRazaoSocial(): string
    {
        return $this->razaoSocial;
    }

    public function setRazaoSocial(string $razaoSocial): ProviderDto
    {
        $this->razaoSocial = $razaoSocial;
        return $this;
    }

    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    public function setCnpj(string $cnpj): ProviderDto
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): ProviderDto
    {
        $this->email = $email;
        return $this;
    }

    public function getDataFundacao(): string
    {
        return $this->dataFundacao;
    }

    public function setDataFundacao(string $dataFundacao): ProviderDto
    {
        $this->dataFundacao = $dataFundacao;
        return $this;
    }

    public function getEnderecos(): array
    {
        return $this->enderecos;
    }

    public function setEnderecos(array $enderecos): ProviderDto
    {
        $this->enderecos = EntityPerson::addrres($enderecos);
        return $this;
    }

    public function getTelefones(): array
    {
        return $this->telefones;
    }

    public function setTelefones(array $telefones): ProviderDto
    {
        $this->telefones = EntityPerson::telephone($telefones);
        return $this;
    }
}
