<?php

namespace App\Services\Address\Concretes;

use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Interfaces\ListAddressServiceInterface;
use Illuminate\Support\Collection;

class ListAddressService implements ListAddressServiceInterface
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function listFederativeUnitAll(): Collection
    {
        return $this->addressRepository->getFederativeUnitAll();
    }
}
