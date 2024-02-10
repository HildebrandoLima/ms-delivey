<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Repositories\Abstracts\IOrderRepository;
use App\Repositories\Concretes\OrderRepository;

class OrderDi
{
    public static $interfaces = [
        IOrderRepository::class,
    ];

    public static $concretes = [
        OrderRepository::class,
    ];
}
