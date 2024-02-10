<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Repositories\Abstracts\IPermissionRepository;
use App\Repositories\Concretes\PermissionRepository;

class PermissionDi
{
    public static $interfaces = [
        IPermissionRepository::class,
    ];

    public static $concretes = [
        PermissionRepository::class,
    ];
}
