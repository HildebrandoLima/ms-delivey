<?php

namespace App\Services\Provider\Interfaces;

use App\Http\Requests\ProviderRequest;

interface CreateProviderServiceInterface
{
    public function createProvider(ProviderRequest $request): int;
}
