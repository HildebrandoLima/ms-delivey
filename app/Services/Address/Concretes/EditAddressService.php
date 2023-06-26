<?php

namespace App\Services\Address\Concretes;

use App\DataTransferObjects\RequestsDtos\AddressRequestDto;
use App\Http\Requests\AddressRequest;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Interfaces\EditAddressServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Enums\PermissionEnum;

class EditAddressService extends ValidationPermission implements EditAddressServiceInterface
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function editAddress($id, AddressRequest $request): bool
    {
        $this->validationPermission(PermissionEnum::EDITAR_ENDERECO);
        $address = AddressRequestDto::fromRquest($request);
        return $this->addressRepository->update($id, $address);
    }
}
