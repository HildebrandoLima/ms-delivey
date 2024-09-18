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
            $items[$key] = $this->mapItems($value);
        }
        return $items;
    }

    private function mapItems(array $data): ItemDto
    {
        return $this->mapper($data, ItemDto::class);
    }

    public function payment(array $payment): array
    {
        foreach ($payment as $key => $value) {
            $payment[$key] = $this->mapPayment($value);
        }
        return $payment;
    }

    private function mapPayment(array $data): PaymentDto
    {
        return $this->mapper($data, PaymentDto::class);
    }
}
