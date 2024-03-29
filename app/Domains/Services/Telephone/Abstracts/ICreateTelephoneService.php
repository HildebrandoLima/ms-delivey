<?php

namespace App\Domains\Services\Telephone\Abstracts;

use App\Http\Requests\Telephone\CreateTelephoneRequest;

interface ICreateTelephoneService
{
    public function createTelephone(CreateTelephoneRequest $request): bool;
}
