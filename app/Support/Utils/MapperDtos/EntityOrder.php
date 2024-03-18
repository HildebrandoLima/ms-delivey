<?php

namespace App\Support\Utils\MapperDtos;

use App\Domains\Dtos\ItemDto;
use App\Domains\Dtos\PaymentDto;

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
        return AutoMapper::map($data, ItemDto::class);
    }

    public static function payment(array $payment): array
    {
        foreach ($payment as $key => $instance):
            $payment[$key] = self::mapPayment($instance);
        endforeach;
        return $payment;
    }

    private static function mapPayment(array $data): PaymentDto
    {
        return AutoMapper::map($data, PaymentDto::class);
    }
}
