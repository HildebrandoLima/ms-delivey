<?php

namespace App\Services\Address\Interfaces;

use App\Http\Requests\AddressRequest;

interface IEditAddressService
{
    public function editAddress($id, AddressRequest $request): bool;
}
