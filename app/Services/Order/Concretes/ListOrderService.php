<?php

namespace App\Services\Order\Concretes;

use App\Repositories\Abstracts\IOrderRepository;
use App\Services\Order\Abstracts\IListOrderService;
use Illuminate\Support\Collection;

class ListOrderService implements IListOrderService
{
    private IOrderRepository $orderRepository;

    public function __construct(IOrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function listOrderAll(string $search, int $id, bool $filter): Collection
    {
        return $this->orderRepository->readAll($search, $id, $filter);
    }

    public function listOrderFind(int $id, bool $filter): Collection
    {
        return $this->orderRepository->readOne($id, $filter);
    }
}
