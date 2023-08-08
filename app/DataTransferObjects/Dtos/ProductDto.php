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

    public function setProdutoId(int $produtoId): void
    {
        $this->produtoId = $produtoId;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getPrecoCusto(): float
    {
        return $this->precoCusto;
    }

    public function setPrecoCusto(float $precoCusto): void
    {
        $this->precoCusto = $precoCusto;
    }

    public function getPrecoVenda(): float
    {
        return $this->precoVenda;
    }

    public function setPrecoVenda(float $precoVenda): void
    {
        $this->precoVenda = $precoVenda;
    }

    public function getMargemLucro(): float
    {
        return $this->margemLucro;
    }

    public function setMargemLucro(float $margemLucro): void
    {
        $this->margemLucro = $margemLucro;
    }

    public function getCodigoBarra(): string
    {
        return $this->codigoBarra;
    }

    public function setCodigoBarra(string $codigoBarra): void
    {
        $this->codigoBarra = $codigoBarra;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getQuantidade(): string
    {
        return $this->quantidade;
    }

    public function setQuantidade(string $quantidade): void
    {
        $this->quantidade = $quantidade;
    }

    public function getUnidadeMedida(): string
    {
        return $this->unidadeMedida;
    }

    public function setUnidadeMedida(string $unidadeMedida): void
    {
        $this->unidadeMedida = $unidadeMedida;
    }

    public function getDataValidade(): string
    {
        return $this->dataValidade;
    }

    public function setDataValidade(string $dataValidade): void
    {
        $this->dataValidade = $dataValidade;
    }

    public function getCategoriaId(): int
    {
        return $this->categoriaId;
    }

    public function setCategoriaId(int $categoriaId): void
    {
        $this->categoriaId = $categoriaId;
    }

    public function getFornecedorId(): int
    {
        return $this->fornecedorId;
    }

    public function setFornecedorId(int $fornecedorId): void
    {
        $this->fornecedorId = $fornecedorId;
    }

    public function getImagens(): array
    {
        return $this->imagens;
    }

    public function setImagens(array $imagens): void
    {
        $this->imagens = EntityProduct::imagens($imagens);
    }
}
