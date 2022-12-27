<?php

namespace App\Services\Telephone;

use App\Http\Requests\Telephone\CreateTelephoneRequest;
use App\Support\Utils\Cases\TypeCase;
use App\Infra\Database\Dao\Telephone\CreateTelephoneDb;

class CreateTelephoneService
{
    private TypeCase          $typeCase;
    private CreateTelephoneDb $createTelephoneDb;

    public function __construct
    (
        TypeCase          $typeCase,
        CreateTelephoneDb $createTelephoneDb
    )
    {
        $this->typeCase          = $typeCase;
        $this->createTelephoneDb = $createTelephoneDb;
    }

    public function createTelephone(CreateTelephoneRequest $request): int
    {
        $tipo = $this->typeCase->typeCase($request->tipo);
        return $this->createTelephoneDb->createTelephone($request, $tipo);
    }
}
