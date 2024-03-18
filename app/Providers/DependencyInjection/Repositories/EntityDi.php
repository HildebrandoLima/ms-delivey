<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Data\Repositories\Concretes\EntityRepository;

class EntityDi
{
    public static $interfaces = [
        IEntityRepository::class,
    ];

    public static $concretes = [
        EntityRepository::class,
    ];
}
