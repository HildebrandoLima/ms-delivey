<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Data\Repositories\Address\Concretes\CreateAddressRepository;
use App\Data\Repositories\Address\Concretes\UpdateAddressRepository;

use App\Data\Repositories\Address\Interfaces\ICreateAddressRepository;
use App\Data\Repositories\Address\Interfaces\IUpdateAddressRepository;

class AddressDi
{
    public static $interfaces = [
        ICreateAddressRepository::class,
        IUpdateAddressRepository::class
    ];

    public static $concretes = [
        CreateAddressRepository::class,
        UpdateAddressRepository::class
    ];
}
