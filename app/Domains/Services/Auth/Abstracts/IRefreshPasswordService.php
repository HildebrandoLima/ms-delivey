<?php

namespace App\Domains\Services\Auth\Abstracts;

use App\Http\Requests\Auth\RefreshPasswordRequest;

interface IRefreshPasswordService
{
    public function refreshPassword(RefreshPasswordRequest $request): bool;
}
