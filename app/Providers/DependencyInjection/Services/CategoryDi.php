<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\Category\Abstracts\ICreateCategoryService;
use App\Domains\Services\Category\Abstracts\IEditCategoryService;
use App\Domains\Services\Category\Abstracts\IListCategoryService;
use App\Domains\Services\Category\Concretes\CreateCategoryService;
use App\Domains\Services\Category\Concretes\EditCategoryService;
use App\Domains\Services\Category\Concretes\ListCategoryService;

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
