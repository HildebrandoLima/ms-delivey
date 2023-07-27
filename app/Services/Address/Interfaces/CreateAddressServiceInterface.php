<?php

namespace App\Services\Address\Interfaces;

use App\Http\Requests\Address\CreateAddressRequest;

interface CreateAddressServiceInterface
{
    public function createAddress(CreateAddressRequest $request): bool;
}
