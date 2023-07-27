<?php

namespace App\Services\Address\Concretes;

use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Interfaces\DeleteAddressServiceInterface;

class DeleteAddressService implements DeleteAddressServiceInterface
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function deleteAddress(int $id, bool $active): bool
    {
        return $this->addressRepository->enableDisable($id, $active);
    }
}
