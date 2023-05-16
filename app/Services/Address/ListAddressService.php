<?php

namespace App\Services\Address;

use App\Exceptions\HttpBadRequest;
use App\Models\User;
use App\Repositories\AddressRepository;
use App\Services\Address\Interfaces\IListAddressService;
use Illuminate\Support\Collection;

class ListAddressService implements IListAddressService
{
    private AddressRepository $addressRepository;

    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function listFederativeUnitAll(): Collection
    {
        return $this->addressRepository->getFederativeUnitAll();
    }

    public function listAddressAll(int $id): Collection
    {
        $this->checkUser($id);
        return $this->addressRepository->getAddressAll($id);
    }

    private function checkUser(int $id): void
    {
        if (User::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('O usuário não existe');
        endif;
    }
}
