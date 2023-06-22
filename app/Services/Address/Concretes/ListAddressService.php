<?php

namespace App\Services\Address\Concretes;

use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Interfaces\ListAddressServiceInterface;
use Illuminate\Support\Collection;

class ListAddressService implements ListAddressServiceInterface
{
    private AddressRepositoryInterface $addressRepositoryInterface;

    public function __construct(AddressRepositoryInterface $addressRepositoryInterface,)
    {
        $this->addressRepositoryInterface = $addressRepositoryInterface;
    }

    public function listFederativeUnitAll(): Collection
    {
        return $this->addressRepositoryInterface->getFederativeUnitAll();
    }
}
