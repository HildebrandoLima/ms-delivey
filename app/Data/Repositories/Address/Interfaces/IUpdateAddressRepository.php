<?php

namespace App\Data\Repositories\Address\Interfaces;

use App\Http\Requests\Address\UpdateAddressRequest;

interface IUpdateAddressRepository
{
    public function update(UpdateAddressRequest $request): bool;
}
