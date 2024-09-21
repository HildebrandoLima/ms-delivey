<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\Order\Concretes\CreateOrderService;
use App\Domains\Services\Order\Concretes\ListAllOrderService;
use App\Domains\Services\Order\Concretes\ListFindByIdOrderService;
use App\Domains\Services\Order\Concretes\UpdateOrderService;

use App\Domains\Services\Order\Interfaces\ICreateOrderService;
use App\Domains\Services\Order\Interfaces\IListAllOrderService;
use App\Domains\Services\Order\Interfaces\IListFindByIdOrderService;
use App\Domains\Services\Order\Interfaces\IUpdateOrderService;

class OrderDi
{
    public static $interfaces = [
        ICreateOrderService::class,
        IListAllOrderService::class,
        IListFindByIdOrderService::class,
        IUpdateOrderService::class
    ];

    public static $concretes = [
        CreateOrderService::class,
        ListAllOrderService::class,
        ListFindByIdOrderService::class,
        UpdateOrderService::class
    ];
}
