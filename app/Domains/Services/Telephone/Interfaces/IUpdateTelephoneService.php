<?php

namespace App\Domains\Services\Telephone\Interfaces;

use App\Http\Requests\Telephone\UpdateTelephoneRequest;

interface IUpdateTelephoneService
{
    public function update(UpdateTelephoneRequest $request): bool;
}
