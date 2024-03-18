<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Data\Repositories\Abstracts\IOrderRepository;
use App\Data\Repositories\Concretes\OrderRepository;

class OrderDi
{
    public static $interfaces = [
        IOrderRepository::class,
    ];

    public static $concretes = [
        OrderRepository::class,
    ];
}
