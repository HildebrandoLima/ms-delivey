<?php

namespace App\Services\Telephone;

use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Infra\Database\Dao\Telephone\EditTelephoneDb;

class EditTelephoneService
{
    private EditTelephoneDb $editTelephoneDb;

    public function __construct(EditTelephoneDb $editTelephoneDb)
    {
        $this->editTelephoneDb = $editTelephoneDb;
    }

    public function editTelephone(EditTelephoneRequest $request): bool
    {
        return $this->editTelephoneDb->editTelephone($request);
    }
}
