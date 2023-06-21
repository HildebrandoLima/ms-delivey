<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\ItemDto;

class ItemMapperDto
{
    public static function mapper(array $items): ItemDto
    {
        return ItemDto::construction()
        ->setItemId($items['id'] ?? 0)
        ->setNome($items['nome'] ?? '')
        ->setPreco($items['preco'] ?? 0)
        ->setCodigoBarra($items['codigo_barra'] ?? '')
        ->setQuantidadeItem($items['quantidade_item'] ?? 0)
        ->setSubTotal($items['sub_total'] ?? 0)
        ->setUnidadeMedida($items['unidade_medida'] ?? '')
        ->setProdutoId($items['produto_id'] ?? 0)
        ->setAtivo($items['ativo'] ?? '')
        ->setCriadoEm($items['created_at'] ?? '')
        ->setAlteradoEm($items['updated_at'] ?? '');
    }
}
