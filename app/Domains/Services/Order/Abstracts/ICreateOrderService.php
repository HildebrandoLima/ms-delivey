<?php

namespace App\Domains\Services\Order\Abstracts;

use App\Http\Requests\Order\CreateOrderRequest;

interface ICreateOrderService
{
    public function createOrder(CreateOrderRequest $request): int;
}
