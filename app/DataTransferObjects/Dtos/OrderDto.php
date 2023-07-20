<?php

namespace App\DataTransferObjects\Dtos;

use App\Support\MapperEntity\EntityOrder;

class OrderDto extends DefaultFields
{
    public int $pedidoId;
    public int $numeroPedido;
    public int $quantidadeItem;
    public float $total;
    public float $entrega;
    public int $usuarioId;
    public array $items;
    public array $pagamento;

    public static function construction(): static
    {
        return new OrderDto();
    }

    public function getPedidoId(): int
    {
        return $this->pedidoId;
    }

    public function setPedidoId(int $pedidoId): OrderDto
    {
        $this->pedidoId = $pedidoId;
        return $this;
    }

    public function getNumeroPedido(): int
    {
        return $this->numeroPedido;
    }

    public function setNumeroPedido(int $numeroPedido): OrderDto
    {
        $this->numeroPedido = $numeroPedido;
        return $this;
    }

    public function getQuantidadeItem(): int
    {
        return $this->quantidadeItem;
    }

    public function setQuantidadeItem(int $quantidadeItem): OrderDto
    {
        $this->quantidadeItem = $quantidadeItem;
        return $this;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setTotal(float $total): OrderDto
    {
        $this->total = $total;
        return $this;
    }

    public function getEntrega(): float
    {
        return $this->entrega;
    }

    public function setEntrega(float $entrega): OrderDto
    {
        $this->entrega = $entrega;
        return $this;
    }

    public function getUsuarioId(): int
    {
        return $this->usuarioId;
    }

    public function setUsuarioId(int $usuarioId): OrderDto
    {
        $this->usuarioId = $usuarioId;
        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): OrderDto
    {
        $this->items = EntityOrder::items($items);
        return $this;
    }

    public function getPagamento(): array
    {
        return $this->pagamento;
    }

    public function setPagamento(array $pagamento): OrderDto
    {
        $this->pagamento = EntityOrder::pagamento($pagamento);
        return $this;
    }
}
