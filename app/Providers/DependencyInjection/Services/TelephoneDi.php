<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\Telephone\Concretes\CreateTelephoneService;
use App\Domains\Services\Telephone\Concretes\UpdateTelephoneService;

use App\Domains\Services\Telephone\Interfaces\ICreateTelephoneService;
use App\Domains\Services\Telephone\Interfaces\IUpdateTelephoneService;

class TelephoneDi
{
    public static $interfaces = [
        ICreateTelephoneService::class,
        IUpdateTelephoneService::class,
    ];

    public static $concretes = [
        CreateTelephoneService::class,
        UpdateTelephoneService::class,
    ];
}
