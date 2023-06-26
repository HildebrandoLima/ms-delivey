<?php

namespace App\Services\Address\Concretes;

use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Interfaces\ListAddressServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Enums\PermissionEnum;
use Illuminate\Support\Collection;

class ListAddressService extends ValidationPermission implements ListAddressServiceInterface
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function listFederativeUnitAll(): Collection
    {
        $this->validationPermission(PermissionEnum::LISTAR_UF);
        return $this->addressRepository->getFederativeUnitAll();
    }
}
