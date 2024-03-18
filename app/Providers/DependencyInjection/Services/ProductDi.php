<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\Product\Abstracts\ICreateProductService;
use App\Domains\Services\Product\Abstracts\IEditProductService;
use App\Domains\Services\Product\Abstracts\IListProductService;
use App\Domains\Services\Product\Concretes\CreateProductService;
use App\Domains\Services\Product\Concretes\EditProductService;
use App\Domains\Services\Product\Concretes\ListProductService;

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
