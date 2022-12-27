<?php

namespace App\Services\Provider;

use App\Http\Requests\Provider\ProviderRequest;
use App\Infra\Database\Dao\Provider\DeleteProviderDb;
use App\Infra\Database\Dao\Address\DeleteAddressDb;
use App\Infra\Database\Dao\Telephone\DeleteTelephoneDb;

class DeleteProviderService
{
    private DeleteProviderDb  $deleteProviderDb;
    private DeleteAddressDb   $deleteAddressDb;
    private DeleteTelephoneDb $deleteTelephoneDb;

    public function __construct
    (
        DeleteProviderDb  $deleteProviderDb,
        DeleteAddressDb   $deleteAddressDb,
        DeleteTelephoneDb $deleteTelephoneDb
    )
    {
        $this->deleteProviderDb  = $deleteProviderDb;
        $this->deleteAddressDb   = $deleteAddressDb;
        $this->deleteTelephoneDb = $deleteTelephoneDb;
    }

    public function deleteProvider(ProviderRequest $request): bool
    {
        $this->deleteProviderDb->deleteProvider($request);
        $this->deleteAddressDb->deleteAddress($request);
        $this->deleteTelephoneDb->deleteTelephone($request);
        return true;
    }
}
