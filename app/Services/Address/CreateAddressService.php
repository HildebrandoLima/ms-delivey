<?php

namespace App\Services\Address;

use App\Http\Requests\Address\CreateAddressRequest;
use App\Support\Utils\Cases\PublicPlaceCase;
use App\Infra\Database\Dao\Address\CreateAddressDb;

class CreateAddressService
{
    private PublicPlaceCase $publicPlaceCase;
    private CreateAddressDb $createAddressDb;

    public function __construct
    (
        PublicPlaceCase $publicPlaceCase,
        CreateAddressDb $createAddressDb
    )
    {
        $this->publicPlaceCase = $publicPlaceCase;
        $this->createAddressDb = $createAddressDb;
    }

    public function createAddress(CreateAddressRequest $request): int
    {
        $logradouro = $this->publicPlaceCase->publicPlaceCase($request->logradouro);
        return $this->createAddressDb->createAddress($request, $logradouro);
    }
}
