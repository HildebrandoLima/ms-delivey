<?php

namespace App\Domains\Services\Address\Abstracts;

use App\Http\Requests\Address\EditAddressRequest;

interface IEditAddressService
{
    public function editAddress(EditAddressRequest $request): bool;
}
