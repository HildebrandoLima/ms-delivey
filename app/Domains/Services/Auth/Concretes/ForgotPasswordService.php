<?php

namespace App\Domains\Services\Auth\Concretes;

use App\Data\Repositories\Auth\Interfaces\IForgotPasswordRepository;
use App\Domains\Services\Auth\Interfaces\IForgotPasswordService;
use App\Domains\Traits\RequestConfigurator;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Jobs\ForgotPassword;

class ForgotPasswordService implements IForgotPasswordService
{
    use RequestConfigurator;
    private IForgotPasswordRepository $forgotPasswordRepository;

    public function __construct(IForgotPasswordRepository $forgotPasswordRepository)
    {
        $this->forgotPasswordRepository = $forgotPasswordRepository;
    }

    public function forgotPassword(ForgotPasswordRequest $request): bool
    {
        $this->setRequest($request);
        $created = $this->created();
        $this->dispatchJob();
        return $created;
    }

    private function created(): bool
    {
        return $this->forgotPasswordRepository->create($this->request);
    }

    private function dispatchJob(): void
    {
        ForgotPassword::dispatch($this->request->email);
    }
}
