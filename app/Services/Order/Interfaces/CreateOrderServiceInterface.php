<?php

namespace App\Services\Order\Interfaces;

use App\Http\Requests\OrderRequest;

interface CreateOrderServiceInterface
{
    public function createOrder(OrderRequest $request): bool;
}
