<?php

namespace App\Services\Address;

use App\Repositories\AddressRepository;
use App\Services\Address\Interfaces\IDeleteAddressService;

class DeleteAddressService implements IDeleteAddressService
{
    private AddressRepository $addressRepository;

    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function deleteAddress(int $id): bool
    {
        return $this->addressRepository->delete($id);
    }
}
