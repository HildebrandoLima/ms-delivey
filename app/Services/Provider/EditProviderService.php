<?php

namespace App\Services\Provider;

use App\Http\Requests\Provider\EditProviderRequest;
use App\Infra\Database\Dao\Provider\EditProviderDb;

class EditProviderService
{
    private EditProviderDb $editProviderDb;

    public function __construct(EditProviderDb $editProviderDb)
    {
        $this->editProviderDb = $editProviderDb;
    }

    public function editProvider(EditProviderRequest $request): bool
    {
        return $this->editProviderDb->editProvider($request);
    }
}
