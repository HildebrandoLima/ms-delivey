<?php

namespace App\Services\Address\Concretes;

use App\DataTransferObjects\RequestsDtos\AddressRequestDto;
use App\Http\Requests\AddressRequest;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Interfaces\CreateAddressServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Enums\PermissionEnum;

class CreateAddressService extends ValidationPermission implements CreateAddressServiceInterface
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function createAddress(AddressRequest $request): int
    {
        $this->validationPermission(PermissionEnum::CRIAR_ENDERECO);
        $address = AddressRequestDto::fromRquest($request);
        return $this->addressRepository->create($address);
    }
}
