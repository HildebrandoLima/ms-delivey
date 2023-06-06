<?php

namespace App\Services\Auth\Interfaces;

use App\Http\Requests\ForgotPasswordRequest;

interface IForgotPasswordService
{
    public function forgotPassword(ForgotPasswordRequest $request): bool;
}
