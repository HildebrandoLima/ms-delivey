<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\OrderDto;

class OrderMapperDto
{
    public static function mapper(array $order): OrderDto
    {
        return OrderDto::construction()
        ->setPedidoId($order['id'] ?? 0)
        ->setQuantidadeItem($order['quantidade_items'] ?? 0)
        ->setTotal($order['total'] ?? 0)
        ->setEntrega($order['entrega'] ?? 0)
        ->setUsuarioId($order['usuario_id'] ?? 0)
        ->setItem($order['item'] ?? [])
        ->setPagamento($order['pagamento'] ?? [])
        ->setAtivo($order['ativo'] ?? '')
        ->setCriadoEm($order['created_at'] ?? '')
        ->setAlteradoEm($order['updated_at'] ?? '');
    }
}
