<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\Telephone\Abstracts\ICreateTelephoneService;
use App\Domains\Services\Telephone\Abstracts\IEditTelephoneService;
use App\Domains\Services\Telephone\Concretes\CreateTelephoneService;
use App\Domains\Services\Telephone\Concretes\EditTelephoneService;

class TelephoneDi
{
    public static $interfaces = [
        ICreateTelephoneService::class,
        IEditTelephoneService::class,
    ];

    public static $concretes = [
        CreateTelephoneService::class,
        EditTelephoneService::class,
    ];
}
