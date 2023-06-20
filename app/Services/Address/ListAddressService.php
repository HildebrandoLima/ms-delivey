<?php

namespace App\Services\Address;

use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Interfaces\IListAddressService;
use Illuminate\Support\Collection;

class ListAddressService implements IListAddressService
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

    public function listAddressAll(int $id, int $active): Collection
    {
        return collect();
    }
}
