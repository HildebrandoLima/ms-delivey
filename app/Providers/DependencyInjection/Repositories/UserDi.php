<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Data\Repositories\User\Concretes\CreateUserRepository;
use App\Data\Repositories\User\Concretes\EmailUserVerifiedAtRepository;
use App\Data\Repositories\User\Concretes\ListAllUserRepository;
use App\Data\Repositories\User\Concretes\ListFindByIdUserRepository;
use App\Data\Repositories\User\Concretes\UpdateUserRepository;

use App\Data\Repositories\User\Interfaces\ICreateUserRepository;
use App\Data\Repositories\User\Interfaces\IEmailUserVerifiedAtRepository;
use App\Data\Repositories\User\Interfaces\IListAllUserRepository;
use App\Data\Repositories\User\Interfaces\IListFindByIdUserRepository;
use App\Data\Repositories\User\Interfaces\IUpdateUserRepository;

class UserDi
{
    public static $interfaces = [
        ICreateUserRepository::class,
        IEmailUserVerifiedAtRepository::class,
        IListAllUserRepository::class,
        IListFindByIdUserRepository::class,
        IUpdateUserRepository::class
    ];

    public static $concretes = [
        CreateUserRepository::class,
        EmailUserVerifiedAtRepository::class,
        ListAllUserRepository::class,
        ListFindByIdUserRepository::class,
        UpdateUserRepository::class
    ];
}
