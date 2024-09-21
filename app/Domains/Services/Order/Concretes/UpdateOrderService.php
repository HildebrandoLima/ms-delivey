<?php

namespace App\Domains\Services\Order\Concretes;

use App\Data\Repositories\Order\Interfaces\IUpdateOrderRepository;
use App\Domains\Services\Order\Interfaces\IUpdateOrderService;
use App\Http\Requests\Order\ParamsOrderRequest;

class UpdateOrderService implements IUpdateOrderService
{
    private IUpdateOrderRepository $updateOrderRepository;

    public function __construct(IUpdateOrderRepository $updateOrderRepository)
    {
        $this->updateOrderRepository = $updateOrderRepository;
    }

    public function update(ParamsOrderRequest $request): bool
    {
        return $this->updateOrderRepository->update($request);
    }
}
