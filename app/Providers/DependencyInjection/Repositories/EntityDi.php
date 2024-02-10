<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Repositories\Abstracts\IEntityRepository;
use App\Repositories\Concretes\EntityRepository;

class EntityDi
{
    public static $interfaces = [
        IEntityRepository::class,
    ];

    public static $concretes = [
        EntityRepository::class,
    ];
}
