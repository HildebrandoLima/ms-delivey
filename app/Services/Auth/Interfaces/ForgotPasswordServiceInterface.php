<?php

namespace App\Services\Auth\Interfaces;

use App\Http\Requests\Auth\ForgotPasswordRequest;

interface ForgotPasswordServiceInterface
{
    public function forgotPassword(ForgotPasswordRequest $request): bool;
}
