<?php

namespace App\Services\Order;

use App\Repositories\ItemRepository;
use App\Repositories\OrderRepository;
use App\Services\Order\Interfaces\IDeleteOrderService;

class DeleteOrderService implements IDeleteOrderService
{
    private OrderRepository $orderRepository;
    private ItemRepository $itemRepository;

    public function __construct
    (
        OrderRepository $orderRepository,
        ItemRepository $itemRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->itemRepository  = $itemRepository;
    }

    public function deleteOrder(int $id): bool
    {
        if ($this->orderRepository->delete($id) and $this->itemRepository->delete($id)):
            return true;
        else:
            return false;
        endif;
    }
}
