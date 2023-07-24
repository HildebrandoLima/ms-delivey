<?php

namespace App\Services\Address\Interfaces;

use App\Http\Requests\Address\EditAddressRequest;

interface EditAddressServiceInterface
{
    public function editAddress(EditAddressRequest $request): bool;
}
