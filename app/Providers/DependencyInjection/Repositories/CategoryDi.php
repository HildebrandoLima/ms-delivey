<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Repositories\Abstracts\ICategoryRepository;
use App\Repositories\Concretes\CategoryRepository;

class CategoryDi
{
    public static $interfaces = [
        ICategoryRepository::class,
    ];

    public static $concretes = [
        CategoryRepository::class,
    ];
}
