<?php

namespace App\Services\Address\Concretes;

use App\Http\Requests\Address\ParamsAddressRequest;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Interfaces\DeleteAddressServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Enums\PermissionEnum;

class DeleteAddressService extends ValidationPermission implements DeleteAddressServiceInterface
{
    private AddressRepositoryInterface $addressRepository;

    public function __construct
    (
        AddressRepositoryInterface $addressRepository,
    )
    {
        $this->addressRepository = $addressRepository;
    }

    public function deleteAddress(ParamsAddressRequest $request): bool
    {
        $this->validationPermission(PermissionEnum::HABILITAR_DESABILITAR_ENDERECO);
        return $this->addressRepository->enableDisable((int)$request->id, (bool)$request->ative);
    }
}
