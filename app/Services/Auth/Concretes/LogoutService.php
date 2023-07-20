<?php

namespace App\Services\Auth\Concretes;

use App\Services\Auth\Interfaces\LogoutServiceInterface;

class LogoutService implements LogoutServiceInterface
{
    public function logout(): bool
    {
        auth()->logout();
        return true;
    }
}
