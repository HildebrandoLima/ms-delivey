<?php

namespace App\Providers\DependencyInjection\Services;

use App\Services\Address\Abstracts\ICreateAddressService;
use App\Services\Address\Abstracts\IEditAddressService;
use App\Services\Address\Abstracts\IIntegrationViaCepService;
use App\Services\Address\Concretes\CreateAddressService;
use App\Services\Address\Concretes\EditAddressService;
use App\Services\Address\Concretes\IntegrationViaCepService;

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
