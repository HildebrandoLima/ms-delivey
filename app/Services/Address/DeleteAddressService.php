<?php

namespace App\Services\Address;

use App\Http\Requests\Address\AddressRequest;
use App\Infra\Database\Dao\Address\DeleteAddressDb;

class DeleteAddressService
{
    private DeleteAddressDb $deleteAddressDb;

    public function __construct(DeleteAddressDb $deleteAddressDb)
    {
        $this->deleteAddressDb = $deleteAddressDb;
    }

    public function deleteAddress(AddressRequest $request): bool
    {
        return $this->deleteAddressDb->deleteAddress($request);
    }
}
