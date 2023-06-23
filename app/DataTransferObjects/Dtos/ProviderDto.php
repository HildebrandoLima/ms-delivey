<?php

namespace App\DataTransferObjects\Dtos;

use App\Support\MapperEntity\EntityPerson;

class ProviderDto extends DefaultFields
{
    public int $fornecedor_id;
    public string $razao_social;
    public string $cnpj;
    public string $email;
    public string $data_fundacao;
    public array $enderecos;
    public array $telefones;

    public static function construction(): static
    {
        return new ProviderDto();
    }

    public function getFornecedorId(): int
    {
        return $this->fornecedor_id;
    }

    public function setFornecedorId(int $fornecedor_id): ProviderDto
    {
        $this->fornecedor_id = $fornecedor_id;
        return $this;
    }

    public function getRazaoSocial(): string
    {
        return $this->razao_social;
    }

    public function setRazaoSocial(string $razao_social): ProviderDto
    {
        $this->razao_social = $razao_social;
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
        return $this->data_fundacao;
    }

    public function setDataFundacao(string $data_fundacao): ProviderDto
    {
        $this->data_fundacao = $data_fundacao;
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
