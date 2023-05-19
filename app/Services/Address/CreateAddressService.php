<?php

namespace App\Services\Address;

use App\Http\Requests\AddressRequest;
use App\Repositories\AddressRepository;
use App\Services\Address\Interfaces\ICreateAddressService;
use App\Support\Utils\CheckRegister\CheckProvider;
use App\Support\Utils\CheckRegister\CheckUser;
use App\Support\Utils\MapToModel\AddressModel;

class CreateAddressService implements ICreateAddressService
{
    private CheckUser $checkUser;
    private CheckProvider $checkProvider;
    private AddressModel $addressModel;
    private AddressRepository $addressRepository;

    public function __construct
    (
        CheckUser         $checkUser,
        CheckProvider     $checkProvider,
        AddressModel      $addressModel,
        AddressRepository $addressRepository
    )
    {
        $this->checkUser         = $checkUser;
        $this->checkProvider     = $checkProvider;
        $this->addressModel      = $addressModel;
        $this->addressRepository = $addressRepository;
    }

    public function createAddress(AddressRequest $request): int
    {
        isset ($request->usuarioId) ? $this->checkUser->checkUserIdExist($request->usuarioId)
        : $this->checkProvider->checkProviderIdExist($request->fornecedorId);
        $address = $this->addressModel->addressModel($request, 'create');
        return $this->addressRepository->insert($address);
    }
}
