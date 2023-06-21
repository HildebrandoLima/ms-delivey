<?php

namespace App\Services\Order;

use App\Repositories\Concretes\ItemRepository;
use App\Repositories\Concretes\OrderRepository;
use App\Services\Order\Interfaces\IDeleteOrderService;

class DeleteOrderService implements IDeleteOrderService
{
    private ItemRepository $itemRepository;
    private OrderRepository $orderRepository;

    public function __construct
    (
        ItemRepository $itemRepository,
        OrderRepository $orderRepository
    )
    {
        $this->itemRepository  = $itemRepository;
        $this->orderRepository = $orderRepository;
    }

    public function deleteOrder(int $id, int $active): bool
    {
        if
        (
            $this->itemRepository->enableDisable($id, $active) and
            $this->orderRepository->enableDisable($id, 0, $active)
        ):
            return true;
        else:
            return false;
        endif;
    }
}
