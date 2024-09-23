<?php

namespace App\Providers\DependencyInjection;

use App\Data\Repositories\Auth\Concretes\AuthRepository;
use App\Data\Repositories\Auth\Concretes\AuthResetRepository;
use App\Data\Repositories\Auth\Concretes\ForgotPasswordRepository;
use App\Data\Repositories\Auth\Concretes\RefreshPasswordRepository;

use App\Data\Repositories\Auth\Interfaces\IAuthRepository;
use App\Data\Repositories\Auth\Interfaces\IAuthResetRepository;
use App\Data\Repositories\Auth\Interfaces\IForgotPasswordRepository;
use App\Data\Repositories\Auth\Interfaces\IRefreshPasswordRepository;

use App\Domains\Services\Auth\Concretes\ForgotPasswordService;
use App\Domains\Services\Auth\Concretes\LoginService;
use App\Domains\Services\Auth\Concretes\LogoutService;
use App\Domains\Services\Auth\Concretes\RefreshPasswordService;

use App\Domains\Services\Auth\Interfaces\IForgotPasswordService;
use App\Domains\Services\Auth\Interfaces\ILoginService;
use App\Domains\Services\Auth\Interfaces\ILogoutService;
use App\Domains\Services\Auth\Interfaces\IRefreshPasswordService;

class AuthDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [IForgotPasswordService::class, ForgotPasswordService::class],
            [ILoginService::class, LoginService::class],
            [ILogoutService::class, LogoutService::class],
            [IRefreshPasswordService::class, RefreshPasswordService::class]
        ];
    }

    protected function repositories(): array
    {
        return [
            [IAuthRepository::class, AuthRepository::class],
            [IAuthResetRepository::class, AuthResetRepository::class],
            [IForgotPasswordRepository::class, ForgotPasswordRepository::class],
            [IRefreshPasswordRepository::class, RefreshPasswordRepository::class]
        ];
    }
}
