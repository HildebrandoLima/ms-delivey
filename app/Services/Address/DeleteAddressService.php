<?php

namespace App\Services\Address;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Address\Interfaces\IDeleteAddressService;

class DeleteAddressService implements IDeleteAddressService
{
    private CheckRegisterRepository    $checkRegisterRepository;
    private AddressRepositoryInterface $addressRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository    $checkRegisterRepository,
        AddressRepositoryInterface $addressRepositoryInterface,
    )
    {
        $this->checkRegisterRepository    = $checkRegisterRepository;
        $this->addressRepositoryInterface = $addressRepositoryInterface;
    }

    public function deleteAddress(int $id, int $ative): bool
    {
        $this->checkRegisterRepository->checkAddressIdExist($id);
        return $this->addressRepositoryInterface->enableDisable($id, $ative);
    }
}
