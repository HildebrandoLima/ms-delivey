<?php

namespace App\Domains\Services\Address\Interfaces;

use App\Http\Requests\Address\UpdateAddressRequest;

interface IUpdateAddressService
{
    public function update(UpdateAddressRequest $request): bool;
}
