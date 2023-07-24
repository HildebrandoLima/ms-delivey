<?php

namespace App\Services\Address\Interfaces;

use App\Http\Requests\Address\AddressRequest;

interface CreateAddressServiceInterface
{
    public function createAddress(AddressRequest $request): bool;
}
