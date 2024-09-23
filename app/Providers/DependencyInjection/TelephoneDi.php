<?php

namespace App\Providers\DependencyInjection;

use App\Data\Repositories\Telephone\Concretes\CreateTelephoneRepository;
use App\Data\Repositories\Telephone\Concretes\UpdateTelephoneRepository;

use App\Data\Repositories\Telephone\Interfaces\ICreateTelephoneRepository;
use App\Data\Repositories\Telephone\Interfaces\IUpdateTelephoneRepository;

use App\Domains\Services\Telephone\Concretes\CreateTelephoneService;
use App\Domains\Services\Telephone\Concretes\UpdateTelephoneService;

use App\Domains\Services\Telephone\Interfaces\ICreateTelephoneService;
use App\Domains\Services\Telephone\Interfaces\IUpdateTelephoneService;

class TelephoneDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [ICreateTelephoneService::class, CreateTelephoneService::class],
            [IUpdateTelephoneService::class, UpdateTelephoneService::class,]
        ];
    }

    protected function repositories(): array
    {
        return [
            [ICreateTelephoneRepository::class, CreateTelephoneRepository::class],
            [IUpdateTelephoneRepository::class, UpdateTelephoneRepository::class]
        ];
    }
}
