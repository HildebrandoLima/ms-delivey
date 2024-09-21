<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\Provider\Concretes\CreateProviderService;
use App\Domains\Services\Provider\Concretes\ListAllProviderService;
use App\Domains\Services\Provider\Concretes\ListFindByIdProviderService;
use App\Domains\Services\Provider\Concretes\UpdateProviderService;
use App\Domains\Services\Provider\Interfaces\ICreateProviderService;
use App\Domains\Services\Provider\Interfaces\IListAllProviderService;
use App\Domains\Services\Provider\Interfaces\IListFindByIdProviderService;
use App\Domains\Services\Provider\Interfaces\IUpdateProviderService;

class ProviderDi
{
    public static $interfaces = [
        ICreateProviderService::class,
        IListAllProviderService::class,
        IListFindByIdProviderService::class,
        IUpdateProviderService::class
    ];

    public static $concretes = [
        CreateProviderService::class,
        ListAllProviderService::class,
        ListFindByIdProviderService::class,
        UpdateProviderService::class
    ];
}
