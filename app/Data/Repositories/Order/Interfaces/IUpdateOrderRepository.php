<?php

namespace App\Data\Repositories\Order\Interfaces;

use App\Http\Requests\Order\ListFindByIdOrderRequest;

interface IUpdateOrderRepository
{
    public function update(ListFindByIdOrderRequest $request): bool;
}
