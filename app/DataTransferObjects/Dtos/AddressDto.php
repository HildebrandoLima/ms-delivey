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
    public string $uf;
    public int|null $usuarioId;
    public int|null $fornecedorId;

    public function __construct
    (
        int $enderecoId,
        string $logradouro,
        string $descricao,
        string $bairro,
        string $cidade,
        string $cep,
        string $uf,
        int|null $usuarioId,
        int|null $fornecedorId,
        string $ativo,
        string $criadoEm,
        string $aleradoEm
    )
    {
        $this->setEnderecoId($enderecoId);
        $this->setLogradouro($logradouro);
        $this->setDescricao($descricao);
        $this->setBairro($bairro);
        $this->setCidade($cidade);
        $this->setCep($cep);
        $this->setUf($uf);
        $this->setUsuarioId($usuarioId);
        $this->setFornecedorId($fornecedorId);
        $this->setAtivo($ativo);
        $this->setCriadoEm($criadoEm);
        $this->setAlteradoEm($aleradoEm);
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

    public function getUf(): string
    {
        return $this->uf;
    }

    public function setUf(string $uf): AddressDto
    {
        $this->uf = $uf;
        return $this;
    }

    public function getUsuarioId(): int|null
    {
        return $this->usuarioId;
    }

    public function setUsuarioId(int|null $usuarioId): AddressDto
    {
        $this->usuarioId = $usuarioId;
        return $this;
    }

    public function getFornecedorId(): int|null
    {
        return $this->fornecedorId;
    }

    public function setFornecedorId(int|null $fornecedorId): AddressDto
    {
        $this->fornecedorId = $fornecedorId;
        return $this;
    }
}
