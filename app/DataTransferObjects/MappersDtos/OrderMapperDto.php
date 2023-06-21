<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\OrderDto;

class OrderMapperDto
{
    public static function mapper(array $order): OrderDto
    {
        return OrderDto::construction()
        ->setPedidoId($order['id'] ?? 0)
        ->setTotalItems($order['total_items'] ?? 0)
        ->setTotal($order['total'] ?? 0)
        ->setEntrega($order['entrega'] ?? 0)
        ->setUsuarioId($order['usuario_id'] ?? 0)
        ->setItems($order['items'] ?? [])
        ->setAtivo($order['ativo'] ?? '')
        ->setCriadoEm($order['created_at'] ?? '')
        ->setAlteradoEm($order['updated_at'] ?? '');
    }
}
