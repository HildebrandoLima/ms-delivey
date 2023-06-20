<?php

namespace App\Services\Address;

use App\DataTransferObjects\RequestsDtos\AddressRequestDto;
use App\Http\Requests\AddressRequest;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Interfaces\ICreateAddressService;

class CreateAddressService implements ICreateAddressService
{
    private AddressRepositoryInterface $addressRepositoryInterface;

    public function __construct(AddressRepositoryInterface $addressRepositoryInterface)
    {
        $this->addressRepositoryInterface = $addressRepositoryInterface;
    }

    public function createAddress(AddressRequest $request): int
    {
        $address = AddressRequestDto::fromRquest($request);
        return $this->addressRepositoryInterface->create($address);
    }
}
