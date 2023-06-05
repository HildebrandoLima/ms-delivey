<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\RefreshPasswordRequest;
use App\Models\PasswordReset;

interface IAuthRepository {
    public function forgotPassword(PasswordReset $passwordReset): bool;
    public function refreshPassword(RefreshPasswordRequest $request): bool;
}
