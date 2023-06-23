<?php

namespace App\Services\Auth\Interfaces;

use App\Http\Requests\RefreshPasswordRequest;

interface RefreshPasswordServiceInterface
{
    public function refreshPassword(RefreshPasswordRequest $request, string $token): bool;
}
