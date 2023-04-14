<?php

namespace App\Services\Address;

use App\Http\Requests\Address\CreateAddressRequest;
use App\Infra\Database\Dao\Address\CreateAddressDb;

class CreateAddressService
{
    private CreateAddressDb $createAddressDb;

    public function __construct(CreateAddressDb $createAddressDb)
    {
        $this->createAddressDb = $createAddressDb;
    }

    public function createAddress(CreateAddressRequest $request): int
    {
        return $this->createAddressDb->createAddress($request);
    }
}
