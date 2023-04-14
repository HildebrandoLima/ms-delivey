<?php

namespace App\Services\Address;

use App\Http\Requests\Address\EditAddressRequest;
use App\Infra\Database\Dao\Address\EditAddressDb;

class EditAddressService
{
    private EditAddressDb $editAddressDb;

    public function __construct(EditAddressDb $editAddressDb)
    {
        $this->editAddressDb = $editAddressDb;
    }

    public function editAddress(EditAddressRequest $request): bool
    {
        return $this->editAddressDb->editAddress($request);
    }
}
