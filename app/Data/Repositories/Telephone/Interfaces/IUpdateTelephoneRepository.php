<?php

namespace App\Data\Repositories\Telephone\Interfaces;

use App\Http\Requests\Telephone\EditTelephoneRequest;

interface IUpdateTelephoneRepository
{
    public function update(EditTelephoneRequest $request): bool;
}
