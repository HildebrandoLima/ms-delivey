<?php

namespace App\Services\Order\Concretes;

use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Order\Interfaces\DeleteOrderServiceInterface;

class DeleteOrderService implements DeleteOrderServiceInterface
{
    private ItemRepositoryInterface  $itemRepositoryInterface;
    private OrderRepositoryInterface $orderRepositoryInterface;

    public function __construct
    (
        ItemRepositoryInterface  $itemRepositoryInterface,
        OrderRepositoryInterface $orderRepositoryInterface,
    )
    {
        $this->itemRepositoryInterface  = $itemRepositoryInterface;
        $this->orderRepositoryInterface = $orderRepositoryInterface;
    }

    public function deleteOrder(int $id, int $active): bool
    {
        if
        (
            $this->itemRepositoryInterface->enableDisable($id, $active) and
            $this->orderRepositoryInterface->enableDisable($id, 0, $active)
        ):
            return true;
        else:
            return false;
        endif;
    }
}
