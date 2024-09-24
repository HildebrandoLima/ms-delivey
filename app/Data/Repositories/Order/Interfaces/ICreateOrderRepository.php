<?php

namespace App\Data\Repositories\Order\Interfaces;

use App\Http\Requests\Order\CreateOrderRequest;

interface ICreateOrderRepository
{
    public function create(CreateOrderRequest $request): array;
}
