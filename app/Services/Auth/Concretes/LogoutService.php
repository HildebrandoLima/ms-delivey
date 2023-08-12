<?php

namespace App\Services\Auth\Concretes;

use App\Services\Auth\Abstracts\ILogoutService;

class LogoutService implements ILogoutService
{
    public function logout(): bool
    {
        auth()->logout();
        return true;
    }
}
