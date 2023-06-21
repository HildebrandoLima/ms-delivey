<?php

namespace App\Services\User;

use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\IDeleteUserService;

class DeleteUserService implements IDeleteUserService
{
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;
    private AddressRepositoryInterface     $addressRepositoryInterface;
    private TelephoneRepositoryInterface   $telephoneRepositoryInterface;
    private ItemRepositoryInterface        $itemRepositoryInterface;
    private OrderRepositoryInterface       $orderRepositoryInterface;
    private UserRepositoryInterface        $userRepositoryInterface;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepositoryInterface,
        AddressRepositoryInterface     $addressRepositoryInterface,
        TelephoneRepositoryInterface   $telephoneRepositoryInterface,
        ItemRepositoryInterface        $itemRepositoryInterface,
        OrderRepositoryInterface       $orderRepositoryInterface,
        UserRepositoryInterface        $userRepositoryInterface
    )
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
        $this->addressRepositoryInterface     = $addressRepositoryInterface;
        $this->telephoneRepositoryInterface   = $telephoneRepositoryInterface;
        $this->itemRepositoryInterface        = $itemRepositoryInterface;
        $this->orderRepositoryInterface       = $orderRepositoryInterface;
        $this->userRepositoryInterface        = $userRepositoryInterface;
    }

    public function deleteUser(int $id, int $active): bool
    {
        $this->checkExists($id);
        if
        (
            $this->addressRepositoryInterface->enableDisable($id, $active) and
            $this->telephoneRepositoryInterface->enableDisable($id, $active) and
            $this->pedidos($id, $active) and
            $this->userRepositoryInterface->enableDisable($id, $active)
        ):
            return true;
        else:
            return false;
        endif;
    }

    public function checkExists(int $id): void
    {
        $this->checkEntityRepositoryInterface->checkUserIdExist($id);
        $this->checkEntityRepositoryInterface->checkAddressIdExist($id);
        $this->checkEntityRepositoryInterface->checkTelephoneIdExist($id);
    }

    private function pedidos(int $id,int $active): bool
    {
        $pedidos = $this->checkEntityRepositoryInterface->getPedidos($id);
        foreach($pedidos as $pedido):
            $this->itemRepositoryInterface->enableDisable($pedido['id'], $active);
            $this->orderRepositoryInterface->enableDisable(0, $pedido['usuario_id'], $active);
        endforeach;
        return true;
    }
}
