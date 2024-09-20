<?php

namespace App\Domains\Services\Auth\Concretes;

use App\Data\Repositories\Auth\Interfaces\IAuthRepository;
use App\Domains\Services\Auth\Abstracts\ILogoutService;

class LogoutService implements ILogoutService
{
    private IAuthRepository $authRepository;

    public function __construct(IAuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function logout(): bool
    {
        return $this->authRepository->logout();
    }
}
