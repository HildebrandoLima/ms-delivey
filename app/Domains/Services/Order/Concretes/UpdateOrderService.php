<?php

namespace App\Domains\Services\Order\Concretes;

use App\Data\Repositories\Order\Interfaces\IUpdateOrderRepository;
use App\Domains\Services\Order\Interfaces\IUpdateOrderService;
use App\Domains\Traits\RequestConfigurator;
use App\Http\Requests\Order\ListFindByIdOrderRequest;

class UpdateOrderService implements IUpdateOrderService
{
    use RequestConfigurator;
    private IUpdateOrderRepository $updateOrderRepository;

    public function __construct(IUpdateOrderRepository $updateOrderRepository)
    {
        $this->updateOrderRepository = $updateOrderRepository;
    }

    public function update(ListFindByIdOrderRequest $request): bool
    {
        $this->setRequest($request);
        return $this->updated();
    }

    private function updated(): bool
    {
        return $this->updateOrderRepository->update($this->request);
    }
}
