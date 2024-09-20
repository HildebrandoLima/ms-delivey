<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Data\Repositories\Provider\Concretes\CreateProviderRepository;
use App\Data\Repositories\Provider\Concretes\ListAllProviderRepository;
use App\Data\Repositories\Provider\Concretes\ListFindByIdProviderRepository;
use App\Data\Repositories\Provider\Concretes\UpdateProviderRepository;

use App\Data\Repositories\Provider\Interfaces\ICreateProviderRepository;
use App\Data\Repositories\Provider\Interfaces\IListAllProviderRepository;
use App\Data\Repositories\Provider\Interfaces\IListFindByIdProviderRepository;
use App\Data\Repositories\Provider\Interfaces\IUpdateProviderRepository;

class ProviderDi
{
    public static $interfaces = [
        ICreateProviderRepository::class,
        IListAllProviderRepository::class,
        IListFindByIdProviderRepository::class,
        IUpdateProviderRepository::class
    ];

    public static $concretes = [
        CreateProviderRepository::class,
        ListAllProviderRepository::class,
        ListFindByIdProviderRepository::class,
        UpdateProviderRepository::class
    ];
}
