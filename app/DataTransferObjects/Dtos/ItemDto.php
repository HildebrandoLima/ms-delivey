<?php

namespace App\DataTransferObjects\Dtos;

class ItemDto extends DefaultFields
{
    public int $itemId;
    public string $nome;
    public float $preco;
    public string $codigoBarra;
    public int $quantidadeItem;
    public float $subTotal;
    public string $unidadeMedida;
    public int $pedidoId;
    public int $produtoId;

    public static function construction(): static
    {
        return new ItemDto();
    }

    public function getItemId(): int
    {
        return $this->itemId;
    }

    public function setItemId(int $itemId): ItemDto
    {
        $this->itemId = $itemId;
        return $this;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): ItemDto
    {
        $this->nome = $nome;
        return $this;
    }

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function setPreco(float $preco): ItemDto
    {
        $this->preco = $preco;
        return $this;
    }

    public function getCodigoBarra(): string
    {
        return $this->codigoBarra;
    }

    public function setCodigoBarra(string $codigoBarra): ItemDto
    {
        $this->codigoBarra = $codigoBarra;
        return $this;
    }

    public function getQuantidadeItem(): int
    {
        return $this->quantidadeItem;
    }

    public function setQuantidadeItem(int $quantidadeItem): ItemDto
    {
        $this->quantidadeItem = $quantidadeItem;
        return $this;
    }

    public function getSubTotal(): float
    {
        return $this->subTotal;
    }

    public function setSubTotal(float $subTotal): ItemDto
    {
        $this->subTotal = $subTotal;
        return $this;
    }

    public function getUnidadeMedida(): string
    {
        return $this->unidadeMedida;
    }

    public function setUnidadeMedida(string $unidadeMedida): ItemDto
    {
        $this->unidadeMedida = $unidadeMedida;
        return $this;
    }

    public function getPedidoId(): int
    {
        return $this->pedidoId;
    }

    public function setPedidoId(int $pedidoId): ItemDto
    {
        $this->pedidoId = $pedidoId;
        return $this;
    }

    public function getProdutoId(): int
    {
        return $this->produtoId;
    }

    public function setProdutoId(int $produtoId): ItemDto
    {
        $this->produtoId = $produtoId;
        return $this;
    }
}
