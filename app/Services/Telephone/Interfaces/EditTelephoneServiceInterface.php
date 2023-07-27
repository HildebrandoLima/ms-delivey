<?php

namespace App\Services\Telephone\Interfaces;

use App\Http\Requests\Telephone\EditTelephoneRequest;

interface EditTelephoneServiceInterface
{
    public function editTelephone(EditTelephoneRequest $request): bool;
}
