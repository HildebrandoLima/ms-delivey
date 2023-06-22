<?php

namespace App\Services\Address\Concretes;

use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Address\Interfaces\DeleteAddressServiceInterface;

class DeleteAddressService implements DeleteAddressServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;
    private AddressRepositoryInterface     $addressRepositoryInterface;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepositoryInterface,
        AddressRepositoryInterface     $addressRepositoryInterface,
    )
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
        $this->addressRepositoryInterface     = $addressRepositoryInterface;
    }

    public function deleteAddress(int $id, int $ative): bool
    {
        $this->checkEntityRepositoryInterface->checkAddressIdExist($id);
        return $this->addressRepositoryInterface->enableDisable($id, $ative);
    }
}
