<?php

namespace App\Services\Address;

use App\Exceptions\HttpBadRequest;
use App\Models\User;
use App\Repositories\AddressRepository;
use Illuminate\Support\Collection;

class ListAddressService
{
    private AddressRepository $addressRepository;

    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function listFederativeUnitAll(): Collection
    {
        return $this->addressRepository->getAllFederativeUnit();
    }

    public function listAddressAll(int $id): Collection
    {
        $this->checkUser($id);
        return $this->addressRepository->getAllAddress($id);
    }

    private function checkUser(int $id): void
    {
        if (User::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('O usuário não existe');
        endif;
    }
}
