<?php

namespace App\Services\Auth;

use App\Services\Auth\Interfaces\ILogoutService;

class LogoutService implements ILogoutService
{
    public function logout(): void
    {
        auth()->logout();
    }
}
