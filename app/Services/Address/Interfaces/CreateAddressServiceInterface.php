<?php

namespace App\Services\Address\Interfaces;

use App\Http\Requests\AddressRequest;

interface CreateAddressServiceInterface
{
    public function createAddress(AddressRequest $request): int;
}
