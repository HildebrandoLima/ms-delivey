<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\Provider\Abstracts\ICreateProviderService;
use App\Domains\Services\Provider\Abstracts\IEditProviderService;
use App\Domains\Services\Provider\Abstracts\IListProviderService;
use App\Domains\Services\Provider\Concretes\CreateProviderService;
use App\Domains\Services\Provider\Concretes\EditProviderService;
use App\Domains\Services\Provider\Concretes\ListProviderService;

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
