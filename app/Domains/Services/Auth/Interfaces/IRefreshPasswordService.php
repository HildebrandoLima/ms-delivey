<?php

namespace App\Domains\Services\Auth\Interfaces;

use App\Http\Requests\Auth\RefreshPasswordRequest;

interface IRefreshPasswordService
{
    public function refreshPassword(RefreshPasswordRequest $request): bool;
}
