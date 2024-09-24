<?php

namespace App\Domains\Services\Provider\Interfaces;

use App\Http\Requests\Provider\UpdateProviderRequest;

interface IUpdateProviderService
{
    public function update(UpdateProviderRequest $request): bool;
}
