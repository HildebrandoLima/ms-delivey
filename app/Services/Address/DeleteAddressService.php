<?php

namespace App\Services\Address;

use App\Http\Requests\Address\AddressRequest;
use App\Infra\Database\Dao\Address\DeleteAddressDb;
use App\Repositories\AddressRepository;

class DeleteAddressService
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
