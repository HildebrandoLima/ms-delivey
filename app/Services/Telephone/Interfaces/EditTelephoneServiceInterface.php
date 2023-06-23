<?php

namespace App\Services\Telephone\Interfaces;

use App\Http\Requests\TelephoneRequest;

interface EditTelephoneServiceInterface
{
    public function editTelephone(int $id, TelephoneRequest $request): bool;
}
