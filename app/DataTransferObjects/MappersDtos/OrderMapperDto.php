<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\OrderDto;

class OrderMapperDto
{
    public static function mapper(array $order): OrderDto
    {
        return new OrderDto
        (
            $order['id'] ?? 0,
            $order['numero_pedido'] ?? 0,
            $order['quantidade_items'] ?? 0,
            $order['total'] ?? 0,
            $order['entrega'] ?? 0,
            $order['usuario_id'] ?? 0,
            $order['item'] ?? [],
            $order['pagamento'] ?? [],
            $order['ativo'] ?? '',
            $order['created_at'] ?? '',
            $order['updated_at'] ?? '',
        );
    }
}
