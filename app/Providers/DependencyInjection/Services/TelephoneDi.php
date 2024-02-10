<?php

namespace App\Providers\DependencyInjection\Services;

use App\Services\Telephone\Abstracts\ICreateTelephoneService;
use App\Services\Telephone\Abstracts\IEditTelephoneService;
use App\Services\Telephone\Concretes\CreateTelephoneService;
use App\Services\Telephone\Concretes\EditTelephoneService;

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
