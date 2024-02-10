<?php

namespace App\Providers\DependencyInjection\Services;

use App\Services\User\Abstracts\ICreateUserService;
use App\Services\User\Abstracts\IEditUserService;
use App\Services\User\Abstracts\IEmailUserVerifiedAtService;
use App\Services\User\Abstracts\IListUserService;
use App\Services\User\Concretes\CreateUserService;
use App\Services\User\Concretes\EditUserService;
use App\Services\User\Concretes\EmailUserVerifiedAtService;
use App\Services\User\Concretes\ListUserService;

class UserDi
{
    public static $interfaces = [
        ICreateUserService::class,
        IEditUserService::class,
        IEmailUserVerifiedAtService::class,
        IListUserService::class,
    ];

    public static $concretes = [
        CreateUserService::class,
        EditUserService::class,
        EmailUserVerifiedAtService::class,
        ListUserService::class,
    ];
}
