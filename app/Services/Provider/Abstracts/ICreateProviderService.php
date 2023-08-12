<?php

namespace App\Services\Provider\Abstracts;

use App\Http\Requests\Provider\CreateProviderRequest;

interface ICreateProviderService
{
    public function createProvider(CreateProviderRequest $request): int;
}
