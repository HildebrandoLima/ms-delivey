<?php

namespace App\DataTransferObjects\RequestsDtos;

use App\DataTransferObjects\Dtos\OrderDto;
use App\Http\Requests\OrderRequest;
use App\Support\Utils\Enums\OrderEnum;

class OrderRequestDto
{
    public static function fromRquest(OrderRequest $request): OrderDto
    {
        $orderDto = new OrderDto();
        $orderDto->setNumeroPedido(random_int(100000000, 999999999));
        $orderDto->setQuantidadeItem($request['quantidadeItems']);
        $orderDto->setTotal($request['total']);
        $orderDto->setEntrega($request['entrega']);
        $orderDto->setUsuarioId($request['usuarioId']);
        $orderDto->setAtivo(OrderEnum::ATIVADO);
        return $orderDto;
    }
}
