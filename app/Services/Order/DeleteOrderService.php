<?php

namespace App\Services\Order;

use App\Repositories\OrderRepository;
use App\Services\Order\Interfaces\IDeleteOrderService;

class DeleteOrderService implements IDeleteOrderService
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function deleteOrder(int $id): int
    {
        return $this->orderRepository->delete($id);
    }
}
