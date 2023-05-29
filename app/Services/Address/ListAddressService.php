<?php

namespace App\Services\Address;

use App\Repositories\AddressRepository;
use App\Repositories\CheckRegisterRepository;
use App\Services\Address\Interfaces\IListAddressService;
use Illuminate\Support\Collection;

class ListAddressService implements IListAddressService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private AddressRepository $addressRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        AddressRepository       $addressRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->addressRepository       = $addressRepository;
    }

    public function listFederativeUnitAll(): Collection
    {
        return $this->addressRepository->getFederativeUnitAll();
    }

    public function listAddressAll(int $id, int $active): Collection
    {
        $this->checkRegisterRepository->checkUserIdExist($id);
        return $this->addressRepository->getAddressAll($id, $active);
    }
}
