<?php

namespace App\Services\User\Concretes;

use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\DeleteUserServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Enums\PermissionEnum;

class DeleteUserService extends ValidationPermission implements DeleteUserServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private AddressRepositoryInterface     $addressRepository;
    private TelephoneRepositoryInterface   $telephoneRepository;
    private ItemRepositoryInterface        $itemRepository;
    private OrderRepositoryInterface       $orderRepository;
    private UserRepositoryInterface        $userRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        AddressRepositoryInterface     $addressRepository,
        TelephoneRepositoryInterface   $telephoneRepository,
        ItemRepositoryInterface        $itemRepository,
        OrderRepositoryInterface       $orderRepository,
        UserRepositoryInterface        $userRepository,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->addressRepository     = $addressRepository;
        $this->telephoneRepository   = $telephoneRepository;
        $this->itemRepository        = $itemRepository;
        $this->orderRepository       = $orderRepository;
        $this->userRepository        = $userRepository;
    }

    public function deleteUser(int $id, int $active): bool
    {
        $this->validationPermission(PermissionEnum::HABILITAR_DESABILITAR_USUARIO);
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
        $this->checkEntityRepository->checkUserIdExist($id);
        $this->checkEntityRepository->checkAddressIdExist($id);
        $this->checkEntityRepository->checkTelephoneIdExist($id);
    }

    private function pedidos(int $id,int $active): bool
    {
        $pedidos = $this->checkEntityRepository->getPedidos($id);
        foreach($pedidos as $pedido):
            $this->itemRepository->enableDisable($pedido['id'], $active);
            $this->orderRepository->enableDisable(0, $pedido['usuario_id'], $active);
        endforeach;
        return true;
    }
}
