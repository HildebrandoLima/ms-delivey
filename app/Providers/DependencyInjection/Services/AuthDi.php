<?php

namespace App\Providers\DependencyInjection\Services;

use App\Services\Auth\Abstracts\IForgotPasswordService;
use App\Services\Auth\Abstracts\ILoginService;
use App\Services\Auth\Abstracts\ILogoutService;
use App\Services\Auth\Abstracts\IRefreshPasswordService;
use App\Services\Auth\Concretes\ForgotPasswordService;
use App\Services\Auth\Concretes\LoginService;
use App\Services\Auth\Concretes\LogoutService;
use App\Services\Auth\Concretes\RefreshPasswordService;

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
