<?php

namespace App\Services\Auth\Abstracts;

interface ILogoutService
{
    public function logout(): bool;
}
