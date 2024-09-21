<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\Product\Concretes\CreateProductService;
use App\Domains\Services\Product\Concretes\ListAllProductService;
use App\Domains\Services\Product\Concretes\ListFindByIdProductService;
use App\Domains\Services\Product\Concretes\UpdateProductService;

use App\Domains\Services\Product\Interfaces\ICreateProductService;
use App\Domains\Services\Product\Interfaces\IListAllProductService;
use App\Domains\Services\Product\Interfaces\IListFindByIdProductService;
use App\Domains\Services\Product\Interfaces\IUpdateProductService;

class ProductDi
{
    public static $interfaces = [
        ICreateProductService::class,
        IListAllProductService::class,
        IListFindByIdProductService::class,
        IUpdateProductService::class
    ];

    public static $concretes = [
        CreateProductService::class,
        ListAllProductService::class,
        ListFindByIdProductService::class,
        UpdateProductService::class
    ];
}
