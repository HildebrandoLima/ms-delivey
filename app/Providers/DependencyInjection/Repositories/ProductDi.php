<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Data\Repositories\Product\Concretes\CreateProductRepository;
use App\Data\Repositories\Product\Concretes\ListAllProductRepository;
use App\Data\Repositories\Product\Concretes\ListFindByIdProductRepository;
use App\Data\Repositories\Product\Concretes\UpdateProductRepository;
use App\Data\Repositories\Product\Interfaces\ICreateProductRepository;
use App\Data\Repositories\Product\Interfaces\IListAllProductRepository;
use App\Data\Repositories\Product\Interfaces\IListFindByIdProductRepository;
use App\Data\Repositories\Product\Interfaces\IUpdateProductRepository;

class ProductDi
{
    public static $interfaces = [
        ICreateProductRepository::class,
        IListAllProductRepository::class,
        IListFindByIdProductRepository::class,
        IUpdateProductRepository::class
    ];

    public static $concretes = [
        CreateProductRepository::class,
        ListAllProductRepository::class,
        ListFindByIdProductRepository::class,
        UpdateProductRepository::class
    ];
}
