<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Data\Repositories\Category\Concretes\CreateCategoryRepository;
use App\Data\Repositories\Category\Concretes\ListAllCategoryRepository;
use App\Data\Repositories\Category\Concretes\ListFindByIdCategoryRepository;
use App\Data\Repositories\Category\Concretes\UpdateCategoryRepository;

use App\Data\Repositories\Category\Interfaces\ICreateCategoryRepository;
use App\Data\Repositories\Category\Interfaces\IListAllCategoryRepository;
use App\Data\Repositories\Category\Interfaces\IListFindByIdCategoryRepository;
use App\Data\Repositories\Category\Interfaces\IUpdateCategoryRepository;

class CategoryDi
{
    public static $interfaces = [
        ICreateCategoryRepository::class,
        IListAllCategoryRepository::class,
        IListFindByIdCategoryRepository::class,
        IUpdateCategoryRepository::class
    ];

    public static $concretes = [
        CreateCategoryRepository::class,
        ListAllCategoryRepository::class,
        ListFindByIdCategoryRepository::class,
        UpdateCategoryRepository::class
    ];
}
