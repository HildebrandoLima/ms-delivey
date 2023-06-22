<?php

namespace App\Services\Address\Concretes;

use App\DataTransferObjects\RequestsDtos\AddressRequestDto;
use App\Http\Requests\AddressRequest;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Interfaces\EditAddressServiceInterface;

class EditAddressService implements EditAddressServiceInterface
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function editAddress($id, AddressRequest $request): bool
    {
        $address = AddressRequestDto::fromRquest($request);
        return $this->addressRepository->update($id, $address);
    }
}
