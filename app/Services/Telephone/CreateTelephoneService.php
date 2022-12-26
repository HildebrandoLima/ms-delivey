<?php

namespace App\Services\Telephone;

use App\Http\Requests\Telephone\CreateTelephoneRequest;
use App\Infra\Database\Dao\Telephone\CreateTelephoneDb;

class CreateTelephoneService
{
    private CreateTelephoneDb $createTelephoneDb;

    public function __construct(CreateTelephoneDb $createTelephoneDb)
    {
        $this->createTelephoneDb = $createTelephoneDb;
    }

    public function createTelephone(CreateTelephoneRequest $request): int
    {
        return $this->createTelephoneDb->createTelephone($request);
    }
}
