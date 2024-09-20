<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Data\Repositories\Auth\Concretes\AuthRepository;
use App\Data\Repositories\Auth\Concretes\AuthResetRepository;
use App\Data\Repositories\Auth\Concretes\ForgotPasswordRepository;
use App\Data\Repositories\Auth\Concretes\RefreshPasswordRepository;

use App\Data\Repositories\Auth\Interfaces\IAuthRepository;
use App\Data\Repositories\Auth\Interfaces\IAuthResetRepository;
use App\Data\Repositories\Auth\Interfaces\IForgotPasswordRepository;
use App\Data\Repositories\Auth\Interfaces\IRefreshPasswordRepository;

class AuthDi
{
    public static $interfaces = [
        IAuthRepository::class,
        IAuthResetRepository::class,
        IForgotPasswordRepository::class,
        IRefreshPasswordRepository::class
    ];

    public static $concretes = [
        AuthRepository::class,
        AuthResetRepository::class,
        ForgotPasswordRepository::class,
        RefreshPasswordRepository::class
    ];
}
