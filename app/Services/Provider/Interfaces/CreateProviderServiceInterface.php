<?php

namespace App\Services\Provider\Interfaces;

use App\Http\Requests\Provider\CreateProviderRequest;

interface CreateProviderServiceInterface
{
    public function createProvider(CreateProviderRequest $request): int;
}
