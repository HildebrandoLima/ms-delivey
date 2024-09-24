<?php

namespace App\Domains\Services\Auth\Interfaces;

interface ILogoutService
{
    public function logout(): bool;
}
