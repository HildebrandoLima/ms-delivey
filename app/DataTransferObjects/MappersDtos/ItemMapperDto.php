<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\ItemDto;

class ItemMapperDto
{
    public static function mapper(array $item): ItemDto
    {
        return new ItemDto
        (
            $item['id'] ?? 0,
            $item['nome'] ?? '',
            $item['preco'] ?? 0,
            $item['codigo_barra'] ?? '',
            $item['quantidade_item'] ?? 0,
            $item['sub_total'] ?? 0,
            $item['unidade_medida'] ?? '',
            $item['pedido_id'] ?? 0,
            $item['produto_id'] ?? 0,
            $item['ativo'] ?? '',
            $item['created_at'] ?? '',
            $item['updated_at'] ?? '',
        );
    }
}
