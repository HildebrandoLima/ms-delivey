<?php

namespace App\Services\Address\Concretes;

use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Address\Interfaces\DeleteAddressServiceInterface;

class DeleteAddressService implements DeleteAddressServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private AddressRepositoryInterface     $addressRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        AddressRepositoryInterface     $addressRepository,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->addressRepository     = $addressRepository;
    }

    public function deleteAddress(int $id, int $ative): bool
    {
        $this->checkEntityRepository->checkAddressIdExist($id);
        return $this->addressRepository->enableDisable($id, $ative);
    }
}
