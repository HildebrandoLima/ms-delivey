<?php

namespace App\Services\Provider\Interfaces;

use App\Http\Requests\ProviderRequest;

interface IEditProviderService
{
    public function editProvider(int $id, ProviderRequest $request): bool;
}
