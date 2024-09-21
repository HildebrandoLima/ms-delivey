<?php

namespace App\Domains\Services\Order\Concretes;

use App\Data\Repositories\Order\Interfaces\IUpdateOrderRepository;
use App\Domains\Services\Order\Interfaces\IUpdateOrderService;
use App\Http\Requests\Order\ParamsOrderRequest;

class UpdateOrderService implements IUpdateOrderService
{
    private IUpdateOrderRepository $updateOrderRepository;
    private ParamsOrderRequest $request;

    public function __construct(IUpdateOrderRepository $updateOrderRepository)
    {
        $this->updateOrderRepository = $updateOrderRepository;
    }

    public function update(ParamsOrderRequest $request): bool
    {
        $this->setRequest($request);
        return $this->updated();
    }

    private function setRequest(ParamsOrderRequest $request): void
    {
        $this->request = $request;
    }

    private function updated(): bool
    {
        return $this->updateOrderRepository->update($this->request);
    }
}
