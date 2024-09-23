<?php

namespace App\Providers\DependencyInjection;

use App\Data\Repositories\Order\Concretes\CreateOrderRepository;
use App\Data\Repositories\Order\Concretes\ListAllOrderRepository;
use App\Data\Repositories\Order\Concretes\ListFindByIdOrderRepository;
use App\Data\Repositories\Order\Concretes\UpdateOrderRepository;

use App\Data\Repositories\Order\Interfaces\ICreateOrderRepository;
use App\Data\Repositories\Order\Interfaces\IListAllOrderRepository;
use App\Data\Repositories\Order\Interfaces\IListFindByIdOrderRepository;
use App\Data\Repositories\Order\Interfaces\IUpdateOrderRepository;

use App\Domains\Services\Order\Concretes\CreateOrderService;
use App\Domains\Services\Order\Concretes\ListAllOrderService;
use App\Domains\Services\Order\Concretes\ListFindByIdOrderService;
use App\Domains\Services\Order\Concretes\UpdateOrderService;

use App\Domains\Services\Order\Interfaces\ICreateOrderService;
use App\Domains\Services\Order\Interfaces\IListAllOrderService;
use App\Domains\Services\Order\Interfaces\IListFindByIdOrderService;
use App\Domains\Services\Order\Interfaces\IUpdateOrderService;

class OrderDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [ICreateOrderService::class, CreateOrderService::class],
            [IListAllOrderService::class, ListAllOrderService::class],
            [IListFindByIdOrderService::class, ListFindByIdOrderService::class,],
            [IUpdateOrderService::class, UpdateOrderService::class]
        ];
    }

    protected function repositories(): array
    {
        return [
            [ICreateOrderRepository::class, CreateOrderRepository::class],
            [IListAllOrderRepository::class, ListAllOrderRepository::class],
            [IListFindByIdOrderRepository::class, ListFindByIdOrderRepository::class],
            [IUpdateOrderRepository::class, UpdateOrderRepository::class]
        ];
    }
}
