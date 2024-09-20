<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Data\Repositories\Telephone\Concretes\CreateTelephoneRepository;
use App\Data\Repositories\Telephone\Concretes\UpdateTelephoneRepository;

use App\Data\Repositories\Telephone\Interfaces\ICreateTelephoneRepository;
use App\Data\Repositories\Telephone\Interfaces\IUpdateTelephoneRepository;

class PhoneDi
{
    public static $interfaces = [
        ICreateTelephoneRepository::class,
        IUpdateTelephoneRepository::class
    ];

    public static $concretes = [
        CreateTelephoneRepository::class,
        UpdateTelephoneRepository::class
    ];
}
