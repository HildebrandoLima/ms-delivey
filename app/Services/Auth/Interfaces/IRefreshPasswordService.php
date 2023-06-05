<?php

namespace App\Services\Auth\Interfaces;

use App\Http\Requests\RefreshPasswordRequest;

interface IRefreshPasswordService
{
    public function refreshPassword(RefreshPasswordRequest $request): bool;
}
