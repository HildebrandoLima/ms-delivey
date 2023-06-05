<?php

namespace App\Services\Auth\Interfaces;

interface IForgotPasswordService
{
    public function forgotPassword(string $email): bool;
}
