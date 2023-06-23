<?php

namespace App\Services\Order\Concretes;

use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Order\Interfaces\ListOrderServiceInterface;
use Illuminate\Support\Collection;

class ListOrderService implements ListOrderServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private OrderRepositoryInterface       $orderRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        OrderRepositoryInterface       $orderRepository,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->orderRepository       = $orderRepository;
    }

    public function listOrderAll(int $active): Collection
    {
        return $this->orderRepository->getAll($active);
    }

    public function listOrderFind(int $id, string $search, int $active): Collection
    {
        if ($id != 0) $this->checkEntityRepository->checkOrderIdExist($id);
        return $this->orderRepository->getOne($id, $search, $active);
    }
}
