<?php

namespace App\Services\Order\Concretes;

use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Services\Order\Interfaces\DeleteOrderServiceInterface;

class DeleteOrderService implements DeleteOrderServiceInterface
{
    private PaymentRepositoryInterface $paymentRepository;
    private ItemRepositoryInterface    $itemRepository;
    private OrderRepositoryInterface   $orderRepository;

    public function __construct
    (
        PaymentRepositoryInterface $paymentRepository,
        ItemRepositoryInterface    $itemRepository,
        OrderRepositoryInterface   $orderRepository,
    )
    {
        $this->paymentRepository  = $paymentRepository;
        $this->itemRepository     = $itemRepository;
        $this->orderRepository    = $orderRepository;
    }

    public function deleteOrder(int $id, bool $active): bool
    {
        if
        (
            $this->paymentRepository->enableDisable($id, $active) and
            $this->itemRepository->enableDisable($id, $active) and
            $this->orderRepository->enableDisable($id, 0, $active)
        ):
            return true;
        else:
            return false;
        endif;
    }
}
