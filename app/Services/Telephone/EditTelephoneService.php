<?php

namespace App\Services\Telephone;

use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Support\Utils\Cases\TypeCase;
use App\Infra\Database\Dao\Telephone\EditTelephoneDb;

class EditTelephoneService
{
    private TypeCase          $typeCase;
    private EditTelephoneDb $editTelephoneDb;

    public function __construct
    (
        TypeCase        $typeCase,
        EditTelephoneDb $editTelephoneDb
    )
    {
        $this->typeCase        = $typeCase;
        $this->editTelephoneDb = $editTelephoneDb;
    }

    public function editTelephone(EditTelephoneRequest $request): bool
    {
        $tipo = $this->typeCase->typeCase($request->tipo);
        return $this->editTelephoneDb->editTelephone($request, $tipo);
    }
}
