<?php

namespace App\Services\Address\Interfaces;

use App\Http\Requests\Address\ParamsAddressRequest;

interface DeleteAddressServiceInterface
{
    public function deleteAddress(ParamsAddressRequest $request): bool;
}
