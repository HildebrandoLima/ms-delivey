<?php

namespace App\Repositories\Interfaces;

use App\Models\PasswordReset;

interface IAuthRepository {
    public function forgotPassword(PasswordReset $passwordReset): bool;
}
