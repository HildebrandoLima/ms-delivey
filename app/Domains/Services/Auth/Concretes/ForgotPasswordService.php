<?php

namespace App\Domains\Services\Auth\Concretes;

use App\Data\Repositories\Auth\Interfaces\IForgotPasswordRepository;
use App\Domains\Services\Auth\Abstracts\IForgotPasswordService;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Jobs\ForgotPassword;

class ForgotPasswordService implements IForgotPasswordService
{
    private IForgotPasswordRepository $forgotPasswordRepository;

    public function __construct(IForgotPasswordRepository $forgotPasswordRepository)
    {
        $this->forgotPasswordRepository = $forgotPasswordRepository;
    }

    public function forgotPassword(ForgotPasswordRequest $request): bool
    {
        $this->forgotPasswordRepository->create($request);
        $this->dispatchJob($request->email);
        return true;
    }

    private function dispatchJob(string $email): void
    {
        ForgotPassword::dispatch($email);
    }
}
