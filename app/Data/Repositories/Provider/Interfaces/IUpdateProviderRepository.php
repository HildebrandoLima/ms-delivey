<?php

namespace App\Data\Repositories\Provider\Interfaces;

use App\Http\Requests\Provider\UpdateProviderRequest;

interface IUpdateProviderRepository
{
    public function update(UpdateProviderRequest $request): bool;
}
