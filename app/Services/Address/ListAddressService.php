<?php

namespace App\Services\Address;

use App\Repositories\AddressRepository;
use Illuminate\Support\Collection;

class ListAddressService
{
    private AddressRepository $addressRepository;

    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function listFederativeUnitAll(): Collection
    {
        return $this->addressRepository->getAllFederativeUnit();
    }

    public function listAddressAll(int $id): Collection
    {
        return $this->addressRepository->getAllAddress($id);
    }
}
