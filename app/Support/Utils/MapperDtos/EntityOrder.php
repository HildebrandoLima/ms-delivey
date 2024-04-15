<?php

namespace App\Support\Utils\MapperDtos;

use App\Domains\Dtos\ItemDto;
use App\Domains\Dtos\PaymentDto;

trait EntityOrder
{
    public function items(array $items): array
    {
        foreach ($items as $key => $instance):
            $items[$key] = $this->mapItems($instance);
        endforeach;
        return $items;
    }

    private function mapItems(array $data): ItemDto
    {
        return AutoMapper::map($data, ItemDto::class);
    }

    public function payment(array $payment): array
    {
        foreach ($payment as $key => $instance):
            $payment[$key] = $this->mapPayment($instance);
        endforeach;
        return $payment;
    }

    private function mapPayment(array $data): PaymentDto
    {
        return AutoMapper::map($data, PaymentDto::class);
    }
}
