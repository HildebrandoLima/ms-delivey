<?php

namespace App\Domains\Services\Provider\Abstracts;

use App\Http\Requests\Provider\EditProviderRequest;

interface IEditProviderService
{
    public function editProvider(EditProviderRequest $request): bool;
}
