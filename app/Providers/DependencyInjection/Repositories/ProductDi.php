<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Data\Repositories\Abstracts\IProductRepository;
use App\Data\Repositories\Concretes\ProductRepository;

class ProductDi
{
    public static $interfaces = [
        IProductRepository::class,
    ];

    public static $concretes = [
        ProductRepository::class,
    ];
}
