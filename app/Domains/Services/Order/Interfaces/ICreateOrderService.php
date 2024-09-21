<?php

namespace App\Domains\Services\Order\Interfaces;

use App\Http\Requests\Order\CreateOrderRequest;

interface ICreateOrderService
{
    public function create(CreateOrderRequest $request): int;
}
