<?php

namespace App\Domains\Services\Auth\Concretes;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Auth\Abstracts\IForgotPasswordService;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Jobs\ForgotPassword;
use App\Models\PasswordReset;
use Illuminate\Support\Str;

class ForgotPasswordService implements IForgotPasswordService
{
    private IEntityRepository $entityRepository;

    public function __construct(IEntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    public function forgotPassword(ForgotPasswordRequest $request): bool
    {
        $passwordReset = $this->map($request);
        $auth = $this->entityRepository->create($passwordReset);
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
