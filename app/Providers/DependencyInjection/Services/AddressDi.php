<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\Address\Abstracts\ICreateAddressService;
use App\Domains\Services\Address\Abstracts\IEditAddressService;
use App\Domains\Services\Address\Abstracts\IIntegrationViaCepService;
use App\Domains\Services\Address\Concretes\CreateAddressService;
use App\Domains\Services\Address\Concretes\EditAddressService;
use App\Domains\Services\Address\Concretes\IntegrationViaCepService;

class AddressDi
{
    public static $interfaces = [
        ICreateAddressService::class,
        IEditAddressService::class,
        IIntegrationViaCepService::class,
    ];

    public static $concretes = [
        CreateAddressService::class,
        EditAddressService::class,
        IntegrationViaCepService::class,
    ];
}
