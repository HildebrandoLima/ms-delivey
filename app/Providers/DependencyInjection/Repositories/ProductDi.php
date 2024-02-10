<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Repositories\Abstracts\IProductRepository;
use App\Repositories\Concretes\ProductRepository;

class ProductDi
{
    public static $interfaces = [
        IProductRepository::class,
    ];

    public static $concretes = [
        ProductRepository::class,
    ];
}
