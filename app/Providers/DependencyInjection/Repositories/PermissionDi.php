<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Data\Repositories\Abstracts\IPermissionRepository;
use App\Data\Repositories\Concretes\PermissionRepository;

class PermissionDi
{
    public static $interfaces = [
        IPermissionRepository::class,
    ];

    public static $concretes = [
        PermissionRepository::class,
    ];
}
