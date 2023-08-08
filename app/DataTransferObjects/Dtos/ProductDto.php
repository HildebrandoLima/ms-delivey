<?php

namespace App\DataTransferObjects\Dtos;

use App\Support\MapperEntity\EntityProduct;

class ProductDto extends DefaultFields
{
    public int $produtoId;
    public string $nome;
    public float $precoCusto;
    public float $precoVenda;
    public float $margemLucro;
    public string $codigoBarra;
    public string $descricao;
    public int $quantidade;
    public string $unidadeMedida;
    public string $dataValidade;
    public int $categoriaId;
    public int $fornecedorId;
    public array $imagens;

    public function __construct
    (
        int $produtoId,
        string $nome,
        float $precoCusto,
        float $precoVenda,
        float $margemLucro,
        string $codigoBarra,
        string $descricao,
        int $quantidade,
        string $unidadeMedida,
        string $dataValidade,
        int $categoriaId,
        int $fornecedorId,
        array $imagens,
        string $ativo,
        string $criadoEm,
        string $aleradoEm
    )
    {
        $this->setProdutoId($produtoId);
        $this->setNome($nome);
        $this->setPrecoCusto($precoCusto);
        $this->setPrecoVenda($precoVenda);
        $this->setMargemLucro($margemLucro);
        $this->setCodigoBarra($codigoBarra);
        $this->setDescricao($descricao);
        $this->setQuantidade($quantidade);
        $this->setUnidadeMedida($unidadeMedida);
        $this->setDataValidade($dataValidade);
        $this->setCategoriaId($categoriaId);
        $this->setFornecedorId($fornecedorId);
        $this->setImagens($imagens);
        $this->setAtivo($ativo);
        $this->setCriadoEm($criadoEm);
        $this->setAlteradoEm($aleradoEm);
    }

    public function getProdutoId(): int
    {
        return $this->produtoId;
    }

    public function setProdutoId(int $produtoId): ProductDto
    {
        $this->produtoId = $produtoId;
        return $this;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): ProductDto
    {
        $this->nome = $nome;
        return $this;
    }

    public function getPrecoCusto(): float
    {
        return $this->precoCusto;
    }

    public function setPrecoCusto(float $precoCusto): ProductDto
    {
        $this->precoCusto = $precoCusto;
        return $this;
    }

    public function getPrecoVenda(): float
    {
        return $this->precoVenda;
    }

    public function setPrecoVenda(float $precoVenda): ProductDto
    {
        $this->precoVenda = $precoVenda;
        return $this;
    }

    public function getMargemLucro(): float
    {
        return $this->margemLucro;
    }

    public function setMargemLucro(float $margemLucro): ProductDto
    {
        $this->margemLucro = $margemLucro;
        return $this;
    }

    public function getCodigoBarra(): string
    {
        return $this->codigoBarra;
    }

    public function setCodigoBarra(string $codigoBarra): ProductDto
    {
        $this->codigoBarra = $codigoBarra;
        return $this;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): ProductDto
    {
        $this->descricao = $descricao;
        return $this;
    }

    public function getQuantidade(): string
    {
        return $this->quantidade;
    }

    public function setQuantidade(string $quantidade): ProductDto
    {
        $this->quantidade = $quantidade;
        return $this;
    }

    public function getUnidadeMedida(): string
    {
        return $this->unidadeMedida;
    }

    public function setUnidadeMedida(string $unidadeMedida): ProductDto
    {
        $this->unidadeMedida = $unidadeMedida;
        return $this;
    }

    public function getDataValidade(): string
    {
        return $this->dataValidade;
    }

    public function setDataValidade(string $dataValidade): ProductDto
    {
        $this->dataValidade = $dataValidade;
        return $this;
    }

    public function getCategoriaId(): int
    {
        return $this->categoriaId;
    }

    public function setCategoriaId(int $categoriaId): ProductDto
    {
        $this->categoriaId = $categoriaId;
        return $this;
    }

    public function getFornecedorId(): int
    {
        return $this->fornecedorId;
    }

    public function setFornecedorId(int $fornecedorId): ProductDto
    {
        $this->fornecedorId = $fornecedorId;
        return $this;
    }

    public function getImagens(): array
    {
        return $this->imagens;
    }

    public function setImagens(array $imagens): ProductDto
    {
        $this->imagens = EntityProduct::imagens($imagens);
        return $this;
    }
}
