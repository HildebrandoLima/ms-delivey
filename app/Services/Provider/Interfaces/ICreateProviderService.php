<?php

namespace App\Services\Provider\Interfaces;

use App\Http\Requests\ProviderRequest;

interface ICreateProviderService
{
    public function createProvider(ProviderRequest $request): int;
}
