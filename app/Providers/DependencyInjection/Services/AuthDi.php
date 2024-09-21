<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\Auth\Concretes\ForgotPasswordService;
use App\Domains\Services\Auth\Concretes\LoginService;
use App\Domains\Services\Auth\Concretes\LogoutService;
use App\Domains\Services\Auth\Concretes\RefreshPasswordService;

use App\Domains\Services\Auth\Interfaces\IForgotPasswordService;
use App\Domains\Services\Auth\Interfaces\ILoginService;
use App\Domains\Services\Auth\Interfaces\ILogoutService;
use App\Domains\Services\Auth\Interfaces\IRefreshPasswordService;

class AuthDi
{
    public static $interfaces = [
        IForgotPasswordService::class,
        ILoginService::class,
        ILogoutService::class,
        IRefreshPasswordService::class,
    ];

    public static $concretes = [
        ForgotPasswordService::class,
        LoginService::class,
        LogoutService::class,
        RefreshPasswordService::class,
    ];
}
