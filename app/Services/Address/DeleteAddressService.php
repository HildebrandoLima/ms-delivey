<?php

namespace App\Services\Address;

use App\Repositories\AddressRepository;
use App\Services\Address\Interfaces\IDeleteAddressService;
use App\Support\Utils\CheckRegister\CheckAddress;

class DeleteAddressService implements IDeleteAddressService
{
    private CheckAddress $checkAddress;
    private AddressRepository $addressRepository;

    public function __construct
    (
        CheckAddress      $checkAddress,
        AddressRepository $addressRepository
    )
    {
        $this->checkAddress      = $checkAddress;
        $this->addressRepository = $addressRepository;
    }

    public function deleteAddress(int $id): bool
    {
        $this->checkAddress->checkAddressIdExist($id);
        return $this->addressRepository->delete($id);
    }
}
