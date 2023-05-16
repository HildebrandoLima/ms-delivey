<?php

namespace App\Services\Address\Interfaces;

use App\Http\Requests\AddressRequest;

interface ICreateAddressService
{
    public function createAddress(AddressRequest $request): int;
}
