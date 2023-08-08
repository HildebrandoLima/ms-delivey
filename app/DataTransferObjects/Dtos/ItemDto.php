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

    public function __construct
    (
        int $itemId,
        string $nome,
        float $preco,
        string $codigoBarra,
        int $quantidadeItem,
        float $subTotal,
        string $unidadeMedida,
        int $pedidoId,
        int $produtoId,
        string $ativo,
        string $criadoEm,
        string $aleradoEm
    )
    {
        $this->setItemId($itemId);
        $this->setNome($nome);
        $this->setPreco($preco);
        $this->setCodigoBarra($codigoBarra);
        $this->setQuantidadeItem($quantidadeItem);
        $this->setSubTotal($subTotal);
        $this->setUnidadeMedida($unidadeMedida);
        $this->setPedidoId($pedidoId);
        $this->setProdutoId($produtoId);
        $this->setAtivo($ativo);
        $this->setCriadoEm($criadoEm);
        $this->setAlteradoEm($aleradoEm);
    }

    public function getItemId(): int
    {
        return $this->itemId;
    }

    public function setItemId(int $itemId): void
    {
        $this->itemId = $itemId;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function setPreco(float $preco): void
    {
        $this->preco = $preco;
    }

    public function getCodigoBarra(): string
    {
        return $this->codigoBarra;
    }

    public function setCodigoBarra(string $codigoBarra): void
    {
        $this->codigoBarra = $codigoBarra;
    }

    public function getQuantidadeItem(): int
    {
        return $this->quantidadeItem;
    }

    public function setQuantidadeItem(int $quantidadeItem): void
    {
        $this->quantidadeItem = $quantidadeItem;
    }

    public function getSubTotal(): float
    {
        return $this->subTotal;
    }

    public function setSubTotal(float $subTotal): void
    {
        $this->subTotal = $subTotal;

    }

    public function getUnidadeMedida(): string
    {
        return $this->unidadeMedida;
    }

    public function setUnidadeMedida(string $unidadeMedida): void
    {
        $this->unidadeMedida = $unidadeMedida;
    }

    public function getPedidoId(): int
    {
        return $this->pedidoId;
    }

    public function setPedidoId(int $pedidoId): void
    {
        $this->pedidoId = $pedidoId;
    }

    public function getProdutoId(): int
    {
        return $this->produtoId;
    }

    public function setProdutoId(int $produtoId): void
    {
        $this->produtoId = $produtoId;
    }
}
