<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\Address\Concretes\CreateAddressService;
use App\Domains\Services\Address\Concretes\IntegrationViaCepService;
use App\Domains\Services\Address\Concretes\UpdateAddressService;

use App\Domains\Services\Address\Interfaces\ICreateAddressService;
use App\Domains\Services\Address\Interfaces\IIntegrationViaCepService;
use App\Domains\Services\Address\Interfaces\IUpdateAddressService;

class AddressDi
{
    public static $interfaces = [
        ICreateAddressService::class,
        IIntegrationViaCepService::class,
        IUpdateAddressService::class,
    ];

    public static $concretes = [
        CreateAddressService::class,
        IntegrationViaCepService::class,
        UpdateAddressService::class,
    ];
}
