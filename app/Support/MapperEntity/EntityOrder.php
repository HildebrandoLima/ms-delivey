<?php

namespace App\Support\MapperEntity;

use App\Dtos\ItemDto;
use App\Dtos\PaymentDto;
use App\Support\AutoMapper\DtoMapper;

class EntityOrder
{
    public static function items(array $items): array
    {
        foreach ($items as $key => $instance):
            $items[$key] = self::mapItems($instance);
        endforeach;
        return $items;
    }

    private static function mapItems(array $data): ItemDto
    {
        return DtoMapper::map($data, ItemDto::class);
    }

    public static function payment(array $pagamento): array
    {
        foreach ($pagamento as $key => $instance):
            $pagamento[$key] = self::mapPayment($instance);
        endforeach;
        return $pagamento;
    }

    private static function mapPayment(array $data): PaymentDto
    {
        return DtoMapper::map($data, PaymentDto::class);
    }
}
