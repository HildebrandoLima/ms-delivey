<?php

namespace App\DataTransferObjects\Dtos;

class AddressDto extends DefaultFields
{
    public int $endereco_id;
    public string $logradouro;
    public string $descricao;
    public string $bairro;
    public string $cidade;
    public string $cep;
    public int $uf_id;
    public int|null $usuario_id;
    public int|null $fornecedor_id;

    public static function construction(): static
    {
        return new AddressDto();
    }

    public function getEnderecoId(): int
    {
        return $this->endereco_id;
    }

    public function setEnderecoId(int $endereco_id): AddressDto
    {
        $this->endereco_id = $endereco_id;
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
        $this->cep = str_replace('-', "", $cep);
        return $this;
    }

    public function getUfId(): int
    {
        return $this->uf_id;
    }

    public function setUfId(int $uf_id): AddressDto
    {
        $this->uf_id = $uf_id;
        return $this;
    }

    public function getUsuarioId(): int|null
    {
        return $this->usuario_id;
    }

    public function setUsuarioId(int|null $usuario_id): AddressDto
    {
        $this->usuario_id = $usuario_id;
        return $this;
    }

    public function getFornecedorId(): int|null
    {
        return $this->fornecedor_id;
    }

    public function setFornecedorId(int|null $fornecedor_id): AddressDto
    {
        $this->fornecedor_id = $fornecedor_id;
        return $this;
    }
}
