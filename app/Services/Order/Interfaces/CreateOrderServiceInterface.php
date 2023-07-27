<?php

namespace App\Services\Order\Interfaces;

use App\Http\Requests\Order\CreateOrderRequest;

interface CreateOrderServiceInterface
{
    public function createOrder(CreateOrderRequest $request): bool;
}
