<?php

namespace App\Domains\Services\Telephone\Interfaces;

use App\Http\Requests\Telephone\CreateTelephoneRequest;

interface ICreateTelephoneService
{
    public function create(CreateTelephoneRequest $request): bool;
}
