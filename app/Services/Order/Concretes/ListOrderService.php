<?php

namespace App\Services\Order\Concretes;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Order\Interfaces\ListOrderServiceInterface;
use Illuminate\Support\Collection;

class ListOrderService implements ListOrderServiceInterface
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function listOrderAll(string $search, int $id, bool $active): Collection
    {
        return $this->orderRepository->getAll($search, $id, $active);
    }

    public function listOrderFind(int $id, bool $active): Collection
    {
        return $this->orderRepository->getOne($id, $active);
    }
}
