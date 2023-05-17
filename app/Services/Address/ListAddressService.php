<?php

namespace App\Services\Address;

use App\Repositories\AddressRepository;
use App\Services\Address\Interfaces\IListAddressService;
use App\Support\Utils\CheckRegister\CheckUser;
use Illuminate\Support\Collection;

class ListAddressService implements IListAddressService
{
    private CheckUser $checkUser;
    private AddressRepository $addressRepository;

    public function __construct
    (
        CheckUser         $checkUser,
        AddressRepository $addressRepository
    )
    {
        $this->checkUser         = $checkUser;
        $this->addressRepository = $addressRepository;
    }

    public function listFederativeUnitAll(): Collection
    {
        return $this->addressRepository->getFederativeUnitAll();
    }

    public function listAddressAll(int $id): Collection
    {
        $this->checkUser->checkUserIdExist($id);
        return $this->addressRepository->getAddressAll($id);
    }
}
