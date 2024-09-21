<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\User\Concretes\CreateUserService;
use App\Domains\Services\User\Concretes\EmailUserVerifiedAtService;
use App\Domains\Services\User\Concretes\ListAllUserService;
use App\Domains\Services\User\Concretes\ListFindByIdUserService;
use App\Domains\Services\User\Concretes\UpdateUserService;

use App\Domains\Services\User\Interfaces\ICreateUserService;
use App\Domains\Services\User\Interfaces\IEmailUserVerifiedAtService;
use App\Domains\Services\User\Interfaces\IListAllUserService;
use App\Domains\Services\User\Interfaces\IListFindByIdUserService;
use App\Domains\Services\User\Interfaces\IUpdateUserService;

class UserDi
{
    public static $interfaces = [
        ICreateUserService::class,
        IEmailUserVerifiedAtService::class,
        IListAllUserService::class,
        IListFindByIdUserService::class,
        IUpdateUserService::class
    ];

    public static $concretes = [
        CreateUserService::class,
        EmailUserVerifiedAtService::class,
        ListAllUserService::class,
        ListFindByIdUserService::class,
        UpdateUserService::class
    ];
}
