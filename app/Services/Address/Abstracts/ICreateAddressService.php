<?php

namespace App\Services\Address\Abstracts;

use App\Http\Requests\Address\CreateAddressRequest;

interface ICreateAddressService
{
    public function createAddress(CreateAddressRequest $request): bool;
}
