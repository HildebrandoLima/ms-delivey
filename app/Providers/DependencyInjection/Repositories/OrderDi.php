<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Data\Repositories\Order\Concretes\CreateOrderRepository;
use App\Data\Repositories\Order\Concretes\ListAllOrderRepository;
use App\Data\Repositories\Order\Concretes\ListFindByIdOrderRepository;
use App\Data\Repositories\Order\Concretes\UpdateOrderRepository;

use App\Data\Repositories\Order\Interfaces\ICreateOrderRepository;
use App\Data\Repositories\Order\Interfaces\IListAllOrderRepository;
use App\Data\Repositories\Order\Interfaces\IListFindByIdOrderRepository;
use App\Data\Repositories\Order\Interfaces\IUpdateOrderRepository;

class OrderDi
{
    public static $interfaces = [
        ICreateOrderRepository::class,
        IListAllOrderRepository::class,
        IListFindByIdOrderRepository::class,
        IUpdateOrderRepository::class
    ];

    public static $concretes = [
        CreateOrderRepository::class,
        ListAllOrderRepository::class,
        ListFindByIdOrderRepository::class,
        UpdateOrderRepository::class
    ];
}
