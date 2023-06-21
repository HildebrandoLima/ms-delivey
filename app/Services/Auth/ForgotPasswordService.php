<?php

namespace App\Services\Auth;

use App\DataTransferObjects\RequestsDtos\AuthRequestDto;
use App\Http\Requests\ForgotPasswordRequest;
use App\Jobs\ForgotPassword;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Services\Auth\Interfaces\IForgotPasswordService;

class ForgotPasswordService implements IForgotPasswordService
{
    private AuthRepositoryInterface $authRepositoryInterface;

    public function __construct(AuthRepositoryInterface $authRepositoryInterface)
    {
        $this->authRepositoryInterface = $authRepositoryInterface;
    }

    public function forgotPassword(ForgotPasswordRequest $request): bool
    {
        $passwordReset = AuthRequestDto::fromRquest($request);
        if ($this->authRepositoryInterface->forgotPassword($passwordReset)):
            ForgotPassword::dispatch((array)$passwordReset);
            return true;
        else:
            return false;
        endif;
    }
}
