<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\Order\Abstracts\ICreateOrderService;
use App\Domains\Services\Order\Abstracts\IEditOrderService;
use App\Domains\Services\Order\Abstracts\IListOrderService;
use App\Domains\Services\Order\Concretes\CreateOrderService;
use App\Domains\Services\Order\Concretes\EditOrderService;
use App\Domains\Services\Order\Concretes\ListOrderService;

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
