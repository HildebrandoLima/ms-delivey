<?php

namespace App\Providers\DependencyInjection\Services;

use App\Services\Category\Abstracts\ICreateCategoryService;
use App\Services\Category\Abstracts\IEditCategoryService;
use App\Services\Category\Abstracts\IListCategoryService;
use App\Services\Category\Concretes\CreateCategoryService;
use App\Services\Category\Concretes\EditCategoryService;
use App\Services\Category\Concretes\ListCategoryService;

class CategoryDi
{
    public static $interfaces = [
        ICreateCategoryService::class,
        IEditCategoryService::class,
        IListCategoryService::class,
    ];

    public static $concretes = [
        CreateCategoryService::class,
        EditCategoryService::class,
        ListCategoryService::class,
    ];
}
