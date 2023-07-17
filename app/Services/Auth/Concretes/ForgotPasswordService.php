<?php

namespace App\Services\Auth\Concretes;

use App\Http\Requests\ForgotPasswordRequest;
use App\Jobs\ForgotPassword;
use App\Models\PasswordReset;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Services\Auth\Interfaces\ForgotPasswordServiceInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Nette\Utils\Arrays;

class ForgotPasswordService implements ForgotPasswordServiceInterface
{
    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function forgotPassword(ForgotPasswordRequest $request): bool
    {
        $passwordReset = $this->map($request);
        if ($this->authRepository->forgotPassword($passwordReset)):
            ForgotPassword::dispatch($passwordReset->toArray());
            return true;
        else:
            return false;
        endif;
    }

    private function map(ForgotPasswordRequest $request): PasswordReset
    {
        $passwordReset = new PasswordReset();
        $passwordReset->email = $request->email;
        $passwordReset->token = Str::uuid();
        $passwordReset->codigo = Str::random(10);
        return $passwordReset;
    }
}
