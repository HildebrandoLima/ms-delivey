<?php

namespace App\Services\User;

use App\Models\Pedido;
use App\Repositories\AddressRepository;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\ItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\TelephoneRepository;
use App\Repositories\UserRepository;
use App\Services\User\Interfaces\IDeleteUserService;

class DeleteUserService implements IDeleteUserService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private AddressRepository $addressRepository;
    private TelephoneRepository $telephoneRepository;
    private ItemRepository $itemRepository;
    private OrderRepository $orderRepository;
    private UserRepository $userRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        AddressRepository       $addressRepository,
        TelephoneRepository     $telephoneRepository,
        ItemRepository          $itemRepository,
        OrderRepository         $orderRepository,
        UserRepository          $userRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->addressRepository       = $addressRepository;
        $this->telephoneRepository     = $telephoneRepository;
        $this->itemRepository          = $itemRepository;
        $this->orderRepository         = $orderRepository;
        $this->userRepository          = $userRepository;
    }

    public function deleteUser(int $id, int $active): bool
    {
        $this->checkExists($id);
        if
        (
            $this->addressRepository->enableDisable($id, $active) and
            $this->telephoneRepository->enableDisable($id, $active) and
            $this->pedidos($id, $active) and
            $this->userRepository->enableDisable($id, $active)
        ):
            return true;
        else:
            return false;
        endif;
    }

    public function checkExists(int $id): void
    {
        $this->checkRegisterRepository->checkUserIdExist($id);
        $this->checkRegisterRepository->checkAddressIdExist($id);
        $this->checkRegisterRepository->checkTelephoneIdExist($id);
    }

    private function pedidos(int $id,int $active): bool
    {
        $pedidos = $this->checkRegisterRepository->getPedidos($id);
        foreach($pedidos as $pedido):
            $this->itemRepository->enableDisable($pedido['id'], $active);
            $this->orderRepository->enableDisable(0, $pedido['usuario_id'], $active);
        endforeach;
        return true;
    }
}
