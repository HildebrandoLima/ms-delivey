<?php

namespace App\Services\Telephone\Interfaces;

use App\Http\Requests\TelephoneRequest;

interface ICreateTelephoneService
{
    public function createTelephone(TelephoneRequest $request): int;
}
