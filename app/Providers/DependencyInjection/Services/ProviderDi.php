<?php

namespace App\Providers\DependencyInjection\Services;

use App\Services\Provider\Abstracts\ICreateProviderService;
use App\Services\Provider\Abstracts\IEditProviderService;
use App\Services\Provider\Abstracts\IListProviderService;
use App\Services\Provider\Concretes\CreateProviderService;
use App\Services\Provider\Concretes\EditProviderService;
use App\Services\Provider\Concretes\ListProviderService;

class ProviderDi
{
    public static $interfaces = [
        ICreateProviderService::class,
        IEditProviderService::class,
        IListProviderService::class,
    ];

    public static $concretes = [
        CreateProviderService::class,
        EditProviderService::class,
        ListProviderService::class,
    ];
}
