<?php

namespace App\Services\Address;

use App\DataTransferObjects\RequestsDtos\AddressRequestDto;
use App\Http\Requests\AddressRequest;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Interfaces\IEditAddressService;

class EditAddressService implements IEditAddressService
{
    private AddressRepositoryInterface $addressRepositoryInterface;

    public function __construct(AddressRepositoryInterface $addressRepositoryInterface)
    {
        $this->addressRepositoryInterface = $addressRepositoryInterface;
    }

    public function editAddress($id, AddressRequest $request): bool
    {
        $address = AddressRequestDto::fromRquest($request);
        return $this->addressRepositoryInterface->update($id, $address);
    }
}
