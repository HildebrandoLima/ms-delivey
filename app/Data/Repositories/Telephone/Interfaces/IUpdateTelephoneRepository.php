<?php

namespace App\Data\Repositories\Telephone\Interfaces;

use App\Http\Requests\Telephone\UpdateTelephoneRequest;

interface IUpdateTelephoneRepository
{
    public function update(UpdateTelephoneRequest $request): bool;
}
