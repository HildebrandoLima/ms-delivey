<?php

namespace App\Providers\DependencyInjection;

use App\Data\Repositories\Provider\Concretes\CreateProviderRepository;
use App\Data\Repositories\Provider\Concretes\ListAllProviderRepository;
use App\Data\Repositories\Provider\Concretes\ListFindByIdProviderRepository;
use App\Data\Repositories\Provider\Concretes\UpdateProviderRepository;

use App\Data\Repositories\Provider\Interfaces\ICreateProviderRepository;
use App\Data\Repositories\Provider\Interfaces\IListAllProviderRepository;
use App\Data\Repositories\Provider\Interfaces\IListFindByIdProviderRepository;
use App\Data\Repositories\Provider\Interfaces\IUpdateProviderRepository;

use App\Domains\Services\Provider\Concretes\CreateProviderService;
use App\Domains\Services\Provider\Concretes\ListAllProviderService;
use App\Domains\Services\Provider\Concretes\ListFindByIdProviderService;
use App\Domains\Services\Provider\Concretes\UpdateProviderService;

use App\Domains\Services\Provider\Interfaces\ICreateProviderService;
use App\Domains\Services\Provider\Interfaces\IListAllProviderService;
use App\Domains\Services\Provider\Interfaces\IListFindByIdProviderService;
use App\Domains\Services\Provider\Interfaces\IUpdateProviderService;

class ProviderDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [ICreateProviderService::class, CreateProviderService::class],
            [IListAllProviderService::class, ListAllProviderService::class],
            [IListFindByIdProviderService::class, ListFindByIdProviderService::class],
            [IUpdateProviderService::class, UpdateProviderService::class]
        ];
    }

    protected function repositories(): array
    {
        return [
            [ICreateProviderRepository::class, CreateProviderRepository::class],
            [IListAllProviderRepository::class, ListAllProviderRepository::class],
            [IListFindByIdProviderRepository::class, ListFindByIdProviderRepository::class],
            [IUpdateProviderRepository::class, UpdateProviderRepository::class]
        ];
    }
}
