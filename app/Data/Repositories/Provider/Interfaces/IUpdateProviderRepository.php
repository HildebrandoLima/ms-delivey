<?php

namespace App\Data\Repositories\Provider\Interfaces;

use App\Http\Requests\Provider\EditProviderRequest;

interface IUpdateProviderRepository
{
    public function update(EditProviderRequest $request): bool;
}
