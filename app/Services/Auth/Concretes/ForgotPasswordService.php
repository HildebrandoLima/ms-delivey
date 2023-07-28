<?php

namespace App\Services\Auth\Concretes;

use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Jobs\ForgotPassword;
use App\Models\PasswordReset;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Services\Auth\Interfaces\ForgotPasswordServiceInterface;
use Illuminate\Support\Str;

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
        $auth = $this->authRepository->forgotPassword($passwordReset);
        if ($auth) $this->dispatchJob($passwordReset->toArray());
        return true;
    }

    private function map(ForgotPasswordRequest $request): PasswordReset
    {
        $passwordReset = new PasswordReset();
        $passwordReset->email = $request->email;
        $passwordReset->token = Str::uuid();
        $passwordReset->codigo = Str::random(10);
        return $passwordReset;
    }

    private function dispatchJob(array $passwordReset): void
    {
        ForgotPassword::dispatch($passwordReset);
    }
}
