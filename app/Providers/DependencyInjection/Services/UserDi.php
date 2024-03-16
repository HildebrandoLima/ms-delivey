<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\User\Abstracts\ICreateUserService;
use App\Domains\Services\User\Abstracts\IEditUserService;
use App\Domains\Services\User\Abstracts\IEmailUserVerifiedAtService;
use App\Domains\Services\User\Abstracts\IListUserService;
use App\Domains\Services\User\Concretes\CreateUserService;
use App\Domains\Services\User\Concretes\EditUserService;
use App\Domains\Services\User\Concretes\EmailUserVerifiedAtService;
use App\Domains\Services\User\Concretes\ListUserService;


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
