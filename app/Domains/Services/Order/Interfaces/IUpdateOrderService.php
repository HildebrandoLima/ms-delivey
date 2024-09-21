<?php

namespace App\Domains\Services\Order\Interfaces;

use App\Http\Requests\Order\ParamsOrderRequest;

interface IUpdateOrderService
{
    public function update(ParamsOrderRequest $request): bool;
}
