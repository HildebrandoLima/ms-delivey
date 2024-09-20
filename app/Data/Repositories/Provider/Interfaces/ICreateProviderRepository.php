<?php

namespace App\Data\Repositories\Provider\Interfaces;

use App\Http\Requests\Provider\CreateProviderRequest;

interface ICreateProviderRepository
{
    public function create(CreateProviderRequest $request): int;
}
