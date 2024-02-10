<?php

namespace App\Providers\DependencyInjection\Services;

use App\Services\Order\Abstracts\ICreateOrderService;
use App\Services\Order\Abstracts\IEditOrderService;
use App\Services\Order\Abstracts\IListOrderService;
use App\Services\Order\Concretes\CreateOrderService;
use App\Services\Order\Concretes\EditOrderService;
use App\Services\Order\Concretes\ListOrderService;

class OrderDi
{
    public static $interfaces = [
        ICreateOrderService::class,
        IEditOrderService::class,
        IListOrderService::class,
    ];

    public static $concretes = [
        CreateOrderService::class,
        EditOrderService::class,
        ListOrderService::class,
    ];
}
