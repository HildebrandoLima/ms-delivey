<?php

namespace App\Domains\Services\Order\Interfaces;

use App\Http\Requests\Order\ListFindByIdOrderRequest;

interface IUpdateOrderService
{
    public function update(ListFindByIdOrderRequest $request): bool;
}
