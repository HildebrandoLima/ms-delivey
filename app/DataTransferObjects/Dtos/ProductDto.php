<?php

namespace App\DataTransferObjects\Dtos;

use App\Support\MapperFunctions;

class ProductDto extends DefaultFields
{
    public int $produto_id;
    public string $nome;
    public float $preco_custo;
    public float $preco_venda;
    public float $margem_lucro;
    public string $codigo_barra;
    public string $descricao;
    public int $quantidade;
    public string $unidade_medida;
    public string $data_validade;
    public int $categoria_id;
    public int $fornecedor_id;
    public array $imagens;

    public static function construction(): static
    {
        return new ProductDto();
    }

    public function getProdutoId(): int
    {
        return $this->produto_id;
    }

    public function setProdutoId(int $produto_id): ProductDto
    {
        $this->produto_id = $produto_id;
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
        return $this->preco_custo;
    }

    public function setPrecoCusto(float $preco_custo): ProductDto
    {
        $this->preco_custo = $preco_custo;
        return $this;
    }

    public function getPrecoVenda(): float
    {
        return $this->preco_venda;
    }

    public function setPrecoVenda(float $preco_venda): ProductDto
    {
        $this->preco_venda = $preco_venda;
        return $this;
    }

    public function getMargemLucro(): float
    {
        return $this->margem_lucro;
    }

    public function setMargemLucro(float $margem_lucro): ProductDto
    {
        $this->margem_lucro = $margem_lucro;
        return $this;
    }

    public function getCodigoBarra(): string
    {
        return $this->codigo_barra;
    }

    public function setCodigoBarra(string $codigo_barra): ProductDto
    {
        $this->codigo_barra = $codigo_barra;
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
        return $this->unidade_medida;
    }

    public function setUnidadeMedida(string $unidade_medida): ProductDto
    {
        $this->unidade_medida = $unidade_medida;
        return $this;
    }

    public function getDataValidade(): string
    {
        return $this->data_validade;
    }

    public function setDataValidade(string $data_validade): ProductDto
    {
        $this->data_validade = $data_validade;
        return $this;
    }

    public function getCategoriaId(): int
    {
        return $this->categoria_id;
    }

    public function setCategoriaId(int $categoria_id): ProductDto
    {
        $this->categoria_id = $categoria_id;
        return $this;
    }

    public function getFornecedorId(): int
    {
        return $this->fornecedor_id;
    }

    public function setFornecedorId(int $fornecedor_id): ProductDto
    {
        $this->fornecedor_id = $fornecedor_id;
        return $this;
    }

    public function getImagens(): array
    {
        return $this->imagens;
    }

    public function setImagens(array $imagens): ProductDto
    {
        $this->imagens = MapperFunctions::imagens($imagens);
        return $this;
    }
}
