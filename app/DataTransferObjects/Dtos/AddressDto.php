<?php

namespace App\DataTransferObjects\Dtos;

class AddressDto extends DefaultFields
{
    public int $enderecoId;
    public string $logradouro;
    public string $descricao;
    public string $bairro;
    public string $cidade;
    public string $cep;
    public int $ufId;
    public int $usuarioId;
    public int $fornecedorId;

    public static function construction(): static
    {
        return new AddressDto();
    }

    public function getEnderecoId(): int
    {
        return $this->enderecoId;
    }

    public function setEnderecoId(int $enderecoId): AddressDto
    {
        $this->enderecoId = $enderecoId;
        return $this;
    }

    public function getLogradouro(): string
    {
        return $this->logradouro;
    }

    public function setLogradouro(string $logradouro): AddressDto
    {
        $this->logradouro = $logradouro;
        return $this;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): AddressDto
    {
        $this->descricao = $descricao;
        return $this;
    }

    public function getBairro(): string
    {
        return $this->bairro;
    }

    public function setBairro(string $bairro): AddressDto
    {
        $this->bairro = $bairro;
        return $this;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function setCidade(string $cidade): AddressDto
    {
        $this->cidade = $cidade;
        return $this;
    }

    public function getCep(): string
    {
        return $this->cep;
    }

    public function setCep(string $cep): AddressDto
    {
        $this->cep = $cep;
        return $this;
    }

    public function getUfId(): int
    {
        return $this->ufId;
    }

    public function setUfId(int $ufId): AddressDto
    {
        $this->ufId = $ufId;
        return $this;
    }

    public function getUsuarioId(): int
    {
        return $this->usuarioId;
    }

    public function setUsuarioId(int $usuarioId): AddressDto
    {
        $this->usuarioId = $usuarioId;
        return $this;
    }

    public function getFornecedorId(): int
    {
        return $this->fornecedorId;
    }

    public function setFornecedorId(int $fornecedorId): AddressDto
    {
        $this->fornecedorId = $fornecedorId;
        return $this;
    }
}
