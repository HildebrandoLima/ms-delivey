<?php

namespace App\Services\Provider\Interfaces;

use App\Http\Requests\Provider\EditProviderRequest;

interface EditProviderServiceInterface
{
    public function editProvider(EditProviderRequest $request): bool;
}
