<?php

namespace App\Services\Order\Concretes;

use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Order\Interfaces\DeleteOrderServiceInterface;

class DeleteOrderService implements DeleteOrderServiceInterface
{
    private ItemRepositoryInterface  $itemRepository;
    private OrderRepositoryInterface $orderRepository;

    public function __construct
    (
        ItemRepositoryInterface  $itemRepository,
        OrderRepositoryInterface $orderRepository,
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
