<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Repositories\Abstracts\IProviderRepository;
use App\Repositories\Concretes\ProviderRepository;

class ProviderDi
{
    public static $interfaces = [
        IProviderRepository::class,
    ];

    public static $concretes = [
        ProviderRepository::class,
    ];
}
