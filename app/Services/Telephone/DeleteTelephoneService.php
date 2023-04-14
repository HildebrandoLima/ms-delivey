<?php

namespace App\Services\Telephone;

use App\Http\Requests\Telephone\TelephoneRequest;
use App\Infra\Database\Dao\Telephone\DeleteTelephoneDb;

class DeleteTelephoneService
{
    private DeleteTelephoneDb $deleteTelephoneDb;

    public function __construct(DeleteTelephoneDb $deleteTelephoneDb)
    {
        $this->deleteTelephoneDb = $deleteTelephoneDb;
    }

    public function deleteTelephone(TelephoneRequest $request): bool
    {
        return $this->deleteTelephoneDb->deleteTelephone($request);
    }
}
