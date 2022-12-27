<?php

namespace App\Services\Provider;

use App\Http\Requests\Provider\CreateProviderRequest;
use App\Infra\Database\Dao\Provider\CreateProviderDb;

class CreateProviderService
{
    private CreateProviderDb $createProviderDb;

    public function __construct(CreateProviderDb $createProviderDb)
    {
        $this->createProviderDb = $createProviderDb;
    }

    public function createProvider(CreateProviderRequest $request): int
    {
        return $this->createProviderDb->createProvider($request);
    }
}
