<?php

namespace App\DataTransferObjects\Dtos;

class ItemDto extends DefaultFields
{
    public int $item_id;
    public string $nome;
    public float $preco;
    public string $codigo_barra;
    public int $quantidade_item;
    public float $sub_total;
    public string $unidade_medida;
    public int $pedido_id;
    public int $produto_id;

    public static function construction(): static
    {
        return new ItemDto();
    }

    public function getItemId(): int
    {
        return $this->item_id;
    }

    public function setItemId(int $item_id): ItemDto
    {
        $this->item_id = $item_id;
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
        return $this->codigo_barra;
    }

    public function setCodigoBarra(string $codigo_barra): ItemDto
    {
        $this->codigo_barra = $codigo_barra;
        return $this;
    }

    public function getQuantidadeItem(): int
    {
        return $this->quantidade_item;
    }

    public function setQuantidadeItem(int $quantidade_item): ItemDto
    {
        $this->quantidade_item = $quantidade_item;
        return $this;
    }

    public function getSubTotal(): float
    {
        return $this->sub_total;
    }

    public function setSubTotal(float $sub_total): ItemDto
    {
        $this->sub_total = $sub_total;
        return $this;
    }

    public function getUnidadeMedida(): string
    {
        return $this->unidade_medida;
    }

    public function setUnidadeMedida(string $unidade_medida): ItemDto
    {
        $this->unidade_medida = $unidade_medida;
        return $this;
    }

    public function getPedidoId(): int
    {
        return $this->pedido_id;
    }

    public function setPedidoId(int $pedido_id): ItemDto
    {
        $this->pedido_id = $pedido_id;
        return $this;
    }

    public function getProdutoId(): int
    {
        return $this->produto_id;
    }

    public function setProdutoId(int $produto_id): ItemDto
    {
        $this->produto_id = $produto_id;
        return $this;
    }
}
