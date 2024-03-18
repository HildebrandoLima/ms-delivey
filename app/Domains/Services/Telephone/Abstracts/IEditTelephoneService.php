<?php

namespace App\Domains\Services\Telephone\Abstracts;

use App\Http\Requests\Telephone\EditTelephoneRequest;

interface IEditTelephoneService
{
    public function editTelephone(EditTelephoneRequest $request): bool;
}
