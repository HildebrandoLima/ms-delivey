<?php

namespace App\Services\Auth\Concretes;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Jobs\ForgotPassword;
use App\Domains\Models\PasswordReset;
use App\Services\Auth\Abstracts\IForgotPasswordService;
use Illuminate\Support\Str;

class ForgotPasswordService implements IForgotPasswordService
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
