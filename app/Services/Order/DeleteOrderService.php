<?php

namespace App\Services\Order;

use App\Repositories\ItemRepository;
use App\Repositories\OrderRepository;
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

    public function deleteOrder(int $id): bool
    {
        if
        (
            $this->itemRepository->delete($id)
            and $this->orderRepository->delete($id)
        ):
            return true;
        else:
            return false;
        endif;
    }
}
