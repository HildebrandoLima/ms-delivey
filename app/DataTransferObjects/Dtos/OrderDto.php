<?php

namespace App\DataTransferObjects\Dtos;

use App\DataTransferObjects\MappersDtos\ItemMapperDto;

class OrderDto extends DefaultFields
{
    public int $pedido_id;
    public int $numero_pedido;
    public int $quantidade_item;
    public float $total;
    public float $entrega;
    public int $usuario_id;
    public array $items;

    public static function construction(): static
    {
        return new OrderDto();
    }

    public function getPedidoId(): int
    {
        return $this->pedido_id;
    }

    public function setPedidoId(int $pedido_id): OrderDto
    {
        $this->pedido_id = $pedido_id;
        return $this;
    }

    public function getNumeroPedido(): int
    {
        return $this->numero_pedido;
    }

    public function setNumeroPedido(int $numero_pedido): OrderDto
    {
        $this->numero_pedido = $numero_pedido;
        return $this;
    }

    public function getQuantidadeItem(): int
    {
        return $this->quantidade_item;
    }

    public function setQuantidadeItem(int $quantidade_item): OrderDto
    {
        $this->quantidade_item = $quantidade_item;
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
        return $this->usuario_id;
    }

    public function setUsuarioId(int $usuario_id): OrderDto
    {
        $this->usuario_id = $usuario_id;
        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): OrderDto
    {
        $this->items = $this->items($items);
        return $this;
    }

    private function items(array $items): array
    {
        foreach ($items as $key => $instance):
            $items[$key] = ItemMapperDto::mapper($instance);
        endforeach;
        return $items;
    }
}
