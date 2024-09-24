<?php

namespace App\Domains\Traits\Dtos;

use App\Domains\Dtos\ItemDto;
use App\Domains\Dtos\PaymentDto;

trait EntityOrder
{
    use AutoMapper;

    public function items(array $items): array
    {
        foreach ($items as $key => $value) {
            $items[$key] = $this->mapTo($value, ItemDto::class);
        }
        return $items;
    }

    public function payment(array $payment): array
    {
        foreach ($payment as $key => $value) {
            $payment[$key] = $this->mapTo($value, PaymentDto::class);
        }
        return $payment;
    }
}
