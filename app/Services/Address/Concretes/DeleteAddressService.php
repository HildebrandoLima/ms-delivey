<?php

namespace App\Services\Address\Concretes;

use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Interfaces\DeleteAddressServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Enums\PermissionEnum;

class DeleteAddressService extends ValidationPermission implements DeleteAddressServiceInterface
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct
    (
        AddressRepositoryInterface $addressRepository,
    )
    {
        $this->addressRepository = $addressRepository;
    }

    public function deleteAddress(int $id, bool $active): bool
    {
        $this->validationPermission(PermissionEnum::HABILITAR_DESABILITAR_ENDERECO);
        return $this->addressRepository->enableDisable($id, $active);
    }
}
