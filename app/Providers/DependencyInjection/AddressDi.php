<?php

namespace App\Providers\DependencyInjection;

use App\Data\Repositories\Address\Concretes\CreateAddressRepository;
use App\Data\Repositories\Address\Concretes\UpdateAddressRepository;

use App\Data\Repositories\Address\Interfaces\ICreateAddressRepository;
use App\Data\Repositories\Address\Interfaces\IUpdateAddressRepository;

use App\Domains\Services\Address\Concretes\CreateAddressService;
use App\Domains\Services\Address\Concretes\IntegrationViaCepService;
use App\Domains\Services\Address\Concretes\UpdateAddressService;

use App\Domains\Services\Address\Interfaces\ICreateAddressService;
use App\Domains\Services\Address\Interfaces\IIntegrationViaCepService;
use App\Domains\Services\Address\Interfaces\IUpdateAddressService;

class AddressDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [ICreateAddressService::class, CreateAddressService::class],
            [IIntegrationViaCepService::class, IntegrationViaCepService::class],
            [IUpdateAddressService::class, UpdateAddressService::class]
        ];
    }

    protected function repositories(): array
    {
        return [
            [ICreateAddressRepository::class, CreateAddressRepository::class],
            [IUpdateAddressRepository::class, UpdateAddressRepository::class]
        ];
    }
}
