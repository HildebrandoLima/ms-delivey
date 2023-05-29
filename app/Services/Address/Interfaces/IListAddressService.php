<?php

namespace App\Services\Address\Interfaces;

use App\Http\Requests\AddressRequest;
use Illuminate\Support\Collection;

interface IListAddressService
{
    public function listFederativeUnitAll(): Collection;
    public function listAddressAll(int $id, int $active): Collection;
}
