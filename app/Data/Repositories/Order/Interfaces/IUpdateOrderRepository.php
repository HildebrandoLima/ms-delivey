<?php

namespace App\Data\Repositories\Order\Interfaces;

use App\Http\Requests\Order\ParamsOrderRequest;

interface IUpdateOrderRepository
{
    public function update(ParamsOrderRequest $request): bool;
}
