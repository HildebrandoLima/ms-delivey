<?php

namespace App\Services\Auth\Interfaces;

use App\Http\Requests\ForgotPasswordRequest;

interface ForgotPasswordServiceInterface
{
    public function forgotPassword(ForgotPasswordRequest $request): bool;
}
