<?php

namespace App\Data\Repositories\Address\Interfaces;

use App\Http\Requests\Address\CreateAddressRequest;

interface ICreateAddressRepository
{
    public function create(CreateAddressRequest $request): bool;
}
