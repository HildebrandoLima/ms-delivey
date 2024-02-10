<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Repositories\Abstracts\IUserRepository;
use App\Repositories\Concretes\UserRepository;

class UserDi
{
    public static $interfaces = [
        IUserRepository::class,
    ];

    public static $concretes = [
        UserRepository::class,
    ];
}
