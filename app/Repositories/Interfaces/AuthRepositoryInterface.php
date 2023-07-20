<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\RefreshPasswordRequest;
use App\Models\PasswordReset;

interface AuthRepositoryInterface
{
    public function create(int $id, int $permission): bool;
    public function forgotPassword(PasswordReset $passwordReset): bool;
    public function refreshPassword(RefreshPasswordRequest $request): bool;
}
