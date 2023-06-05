<?php

namespace App\Repositories;

use App\Models\PasswordReset;
use App\Repositories\Interfaces\IAuthRepository;

class AuthRepositoy implements IAuthRepository {

    public function forgotPassword(PasswordReset $passwordReset): bool
    {
        return PasswordReset::query()->insert($passwordReset->toArray());
    }
}
