<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Data\Repositories\Abstracts\IUserRepository;
use App\Data\Repositories\Concretes\UserRepository;

class UserDi
{
    public static $interfaces = [
        IUserRepository::class,
    ];

    public static $concretes = [
        UserRepository::class,
    ];
}
