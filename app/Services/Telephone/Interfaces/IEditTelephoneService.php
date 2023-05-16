<?php

namespace App\Services\Telephone\Interfaces;

use App\Http\Requests\TelephoneRequest;

interface IEditTelephoneService
{
    public function editTelephone(int $id, TelephoneRequest $request): bool;
}
