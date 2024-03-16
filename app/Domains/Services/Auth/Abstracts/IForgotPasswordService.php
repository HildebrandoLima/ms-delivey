<?php

namespace App\Domains\Services\Auth\Abstracts;

use App\Http\Requests\Auth\ForgotPasswordRequest;

interface IForgotPasswordService
{
    public function forgotPassword(ForgotPasswordRequest $request): bool;
}
