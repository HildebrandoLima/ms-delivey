<?php

namespace App\Services\Auth\Concretes;

use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Jobs\ForgotPassword;
use App\Models\PasswordReset;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Auth\Interfaces\ForgotPasswordServiceInterface;
use Illuminate\Support\Str;

class ForgotPasswordService implements ForgotPasswordServiceInterface
{
    private IEntityRepository $authRepository;

    public function __construct(IEntityRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function forgotPassword(ForgotPasswordRequest $request): bool
    {
        $passwordReset = $this->map($request);
        $auth = $this->authRepository->create($passwordReset);
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
