<?php

namespace App\Domains\Services\Provider\Interfaces;

use App\Http\Requests\Provider\CreateProviderRequest;

interface ICreateProviderService
{
    public function create(CreateProviderRequest $request): int;
}
