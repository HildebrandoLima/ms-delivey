<?php

namespace App\Services\Auth\Interfaces;

use App\Http\Requests\Auth\RefreshPasswordRequest;

interface RefreshPasswordServiceInterface
{
    public function refreshPassword(RefreshPasswordRequest $request): bool;
}
