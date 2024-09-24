<?php

namespace App\Providers\DependencyInjection;

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

class UserDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [ICreateUserService::class, CreateUserService::class],
            [IEmailUserVerifiedAtService::class, EmailUserVerifiedAtService::class],
            [IListAllUserService::class, ListAllUserService::class],
            [IListFindByIdUserService::class, ListFindByIdUserService::class],
            [IUpdateUserService::class, UpdateUserService::class]
        ];
    }

    protected function repositories(): array
    {
        return [
            [ICreateUserRepository::class, CreateUserRepository::class],
            [IEmailUserVerifiedAtRepository::class, EmailUserVerifiedAtRepository::class],
            [IListAllUserRepository::class, ListAllUserRepository::class],
            [IListFindByIdUserRepository::class, ListFindByIdUserRepository::class],
            [IUpdateUserRepository::class, UpdateUserRepository::class]
        ];
    }
}
