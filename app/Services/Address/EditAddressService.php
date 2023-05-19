<?php

namespace App\Services\Address;

use App\Http\Requests\AddressRequest;
use App\Repositories\AddressRepository;
use App\Services\Address\Interfaces\IEditAddressService;
use App\Support\Utils\CheckRegister\CheckProvider;
use App\Support\Utils\CheckRegister\CheckUser;
use App\Support\Utils\MapToModel\AddressModel;

class EditAddressService implements IEditAddressService
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

    public function editAddress($id, AddressRequest $request): bool
    {
        isset ($request->usuarioId) ? $this->checkUser->checkUserIdExist($request->usuarioId)
        : $this->checkProvider->checkProviderIdExist($request->fornecedorId);
        $address = $this->addressModel->addressModel($request, 'edit');
        return $this->addressRepository->update($id, $address);
    }
}
