<?php

namespace App\Domains\Services\Order\Abstracts;

use App\Http\Requests\Order\ParamsOrderRequest;

interface IEditOrderService
{
    public function editOrder(ParamsOrderRequest $request): bool;
}
