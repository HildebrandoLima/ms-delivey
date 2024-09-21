<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\Category\Concretes\CreateCategoryService;
use App\Domains\Services\Category\Concretes\ListAllCategoryService;
use App\Domains\Services\Category\Concretes\ListFindByIdCategoryService;
use App\Domains\Services\Category\Concretes\UpdateCategoryService;

use App\Domains\Services\Category\Interfaces\ICreateCategoryService;
use App\Domains\Services\Category\Interfaces\IListAllCategoryService;
use App\Domains\Services\Category\Interfaces\IListFindByIdCategoryService;
use App\Domains\Services\Category\Interfaces\IUpdateCategoryService;

class CategoryDi
{
    public static $interfaces = [
        ICreateCategoryService::class,
        IListAllCategoryService::class,
        IListFindByIdCategoryService::class,
        IUpdateCategoryService::class
    ];

    public static $concretes = [
        CreateCategoryService::class,
        ListAllCategoryService::class,
        ListFindByIdCategoryService::class,
        UpdateCategoryService::class
    ];
}
