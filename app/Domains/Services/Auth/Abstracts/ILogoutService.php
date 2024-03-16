<?php

namespace App\Domains\Services\Auth\Abstracts;

interface ILogoutService
{
    public function logout(): bool;
}
