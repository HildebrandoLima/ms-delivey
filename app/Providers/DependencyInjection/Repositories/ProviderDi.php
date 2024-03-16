<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Data\Repositories\Abstracts\IProviderRepository;
use App\Data\Repositories\Concretes\ProviderRepository;

class ProviderDi
{
    public static $interfaces = [
        IProviderRepository::class,
    ];

    public static $concretes = [
        ProviderRepository::class,
    ];
}
