<?php

namespace App\Services\Order\Interfaces;

use App\Http\Requests\OrderRequest;

interface ICreateOrderService
{
    public function createOrder(OrderRequest $request): int;
}
