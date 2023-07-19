<?php

namespace App\DataTransferObjects\RequestsDtos;

use App\DataTransferObjects\Dtos\ItemDto;
use App\Support\Utils\Enums\ItemEnum;

class ItemRequestDto
{
    public static function fromRquest(array $item, int $orderId): ItemDto
    {
        $itemDto = new ItemDto();
        $itemDto->setNome($item['nome']);
        $itemDto->setPreco($item['preco']);
        $itemDto->setCodigoBarra($item['codigoBarra']);
        $itemDto->setQuantidadeItem($item['quantidadeItem']);
        $itemDto->setSubTotal($item['subTotal']);
        $itemDto->setUnidadeMedida($item['unidadeMedida']);
        $itemDto->setPedidoId($orderId);
        $itemDto->setProdutoId($item['produtoId']);
        $itemDto->setAtivo(ItemEnum::ATIVADO);
        return $itemDto;
    }
}
