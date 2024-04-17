<?php

namespace App\Domains\Traits\Dtos;

use App\Domains\Dtos\ItemDto;
use App\Domains\Dtos\PaymentDto;

trait EntityOrder
{
    use AutoMapper;

    public function items(array $items): array
    {
        foreach ($items as $key => $instance):
            $items[$key] = $this->mapItems($instance);
        endforeach;
        return $items;
    }

    private function mapItems(array $data): ItemDto
    {
        return $this->mapper($data, ItemDto::class);
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
        return $this->mapper($data, PaymentDto::class);
    }
}
