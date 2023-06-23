<?php

namespace App\Services\Auth\Concretes;

use App\DataTransferObjects\RequestsDtos\AuthRequestDto;
use App\Http\Requests\ForgotPasswordRequest;
use App\Jobs\ForgotPassword;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Services\Auth\Interfaces\ForgotPasswordServiceInterface;

class ForgotPasswordService implements ForgotPasswordServiceInterface

{
    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function forgotPassword(ForgotPasswordRequest $request): bool
    {
        $passwordReset = AuthRequestDto::fromRquest($request);
        if ($this->authRepository->forgotPassword($passwordReset)):
            ForgotPassword::dispatch((array)$passwordReset);
            return true;
        else:
            return false;
        endif;
    }
}
