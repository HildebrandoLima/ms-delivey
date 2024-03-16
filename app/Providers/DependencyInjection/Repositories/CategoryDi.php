<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Data\Repositories\Abstracts\ICategoryRepository;
use App\Data\Repositories\Concretes\CategoryRepository;

class CategoryDi
{
    public static $interfaces = [
        ICategoryRepository::class,
    ];

    public static $concretes = [
        CategoryRepository::class,
    ];
}
