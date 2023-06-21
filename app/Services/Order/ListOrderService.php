<?php

namespace App\Services\Order;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\Concretes\OrderRepository;
use App\Services\Order\Interfaces\IListOrderService;
use Illuminate\Support\Collection;

class ListOrderService implements IListOrderService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private OrderRepository $orderRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        OrderRepository         $orderRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->orderRepository         = $orderRepository;
    }

    public function listOrderAll(int $active): Collection
    {
        return $this->orderRepository->getAll($active);
    }

    public function listOrderFind(int $id, string $search, int $active): Collection
    {
        if ($id != 0) $this->checkRegisterRepository->checkOrderIdExist($id);
        return $this->orderRepository->getOne($id, $search, $active);
    }
}
