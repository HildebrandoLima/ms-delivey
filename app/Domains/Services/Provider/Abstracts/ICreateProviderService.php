<?php

namespace App\Domains\Services\Provider\Abstracts;

use App\Http\Requests\Provider\CreateProviderRequest;

interface ICreateProviderService
{
    public function createProvider(CreateProviderRequest $request): int;
}
