<?php

namespace App\Domains\Services\Address\Interfaces;

use App\Http\Requests\Address\CreateAddressRequest;

interface ICreateAddressService
{
    public function create(CreateAddressRequest $request): bool;
}
