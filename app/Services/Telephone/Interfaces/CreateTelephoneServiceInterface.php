<?php

namespace App\Services\Telephone\Interfaces;

use App\Http\Requests\TelephoneRequest;

interface CreateTelephoneServiceInterface
{
    public function createTelephone(TelephoneRequest $request): int;
}
