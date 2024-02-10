<?php

namespace App\Providers\DependencyInjection\Services;

use App\Services\Product\Abstracts\ICreateProductService;
use App\Services\Product\Abstracts\IEditProductService;
use App\Services\Product\Abstracts\IListProductService;
use App\Services\Product\Concretes\CreateProductService;
use App\Services\Product\Concretes\EditProductService;
use App\Services\Product\Concretes\ListProductService;

class ProductDi
{
    public static $interfaces = [
        ICreateProductService::class,
        IEditProductService::class,
        IListProductService::class,
    ];

    public static $concretes = [
        CreateProductService::class,
        EditProductService::class,
        ListProductService::class,
    ];
}
