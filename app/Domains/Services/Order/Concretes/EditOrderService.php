<?php

namespace App\Domains\Services\Order\Concretes;

use App\Data\Repositories\Order\Interfaces\IUpdateOrderRepository;
use App\Domains\Services\Order\Abstracts\IEditOrderService;
use App\Http\Requests\Order\ParamsOrderRequest;

class EditOrderService implements IEditOrderService
{
    private IUpdateOrderRepository $updateOrderRepository;

    public function __construct(IUpdateOrderRepository $updateOrderRepository)
    {
        $this->updateOrderRepository = $updateOrderRepository;
    }

    public function editOrder(ParamsOrderRequest $request): bool
    {
        return $this->updateOrderRepository->update($request);
    }
}
