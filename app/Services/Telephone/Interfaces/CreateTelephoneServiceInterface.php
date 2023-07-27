<?php

namespace App\Services\Telephone\Interfaces;

use App\Http\Requests\Telephone\CreateTelephoneRequest;

interface CreateTelephoneServiceInterface
{
    public function createTelephone(CreateTelephoneRequest $request): bool;
}
