<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\Auth\RefreshPasswordRequest;
use App\Models\PasswordReset;

interface AuthRepositoryInterface
{
    public function forgotPassword(PasswordReset $passwordReset): bool;
    public function refreshPassword(RefreshPasswordRequest $request): bool;
}
