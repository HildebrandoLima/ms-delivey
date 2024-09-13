<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Data\Repositories\Abstracts\IAuthRepository;
use App\Data\Repositories\Concretes\AuthRepository;

class AuthDi
{
    public static $interfaces = [
        IAuthRepository::class,
    ];

    public static $concretes = [
        AuthRepository::class,
    ];
}
