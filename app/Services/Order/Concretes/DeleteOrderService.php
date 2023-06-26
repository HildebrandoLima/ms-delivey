<?php

namespace App\Services\Order\Concretes;

use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Services\Order\Interfaces\DeleteOrderServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Enums\PermissionEnum;

class DeleteOrderService extends ValidationPermission implements DeleteOrderServiceInterface
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

    public function deleteOrder(int $id, int $active): bool
    {
        $this->validationPermission(PermissionEnum::HABILITAR_DESABILITAR_PEDIDO);
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
