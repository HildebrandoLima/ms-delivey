<?php

namespace App\Services\Address;

use App\Repositories\AddressRepository;
use App\Repositories\CheckRegisterRepository;
use App\Services\Address\Interfaces\IDeleteAddressService;

class DeleteAddressService implements IDeleteAddressService
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

    public function deleteAddress(int $id, int $ative): bool
    {
        $this->checkRegisterRepository->checkAddressIdExist($id);
        return $this->addressRepository->enableDisable($id, $ative);
    }
}
