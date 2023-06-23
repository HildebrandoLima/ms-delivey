<?php

namespace App\Services\Address\Interfaces;

use App\Http\Requests\AddressRequest;

interface EditAddressServiceInterface
{
    public function editAddress($id, AddressRequest $request): bool;
}
