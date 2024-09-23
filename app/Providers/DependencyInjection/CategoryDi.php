<?php

namespace App\Providers\DependencyInjection;

use App\Data\Repositories\Category\Concretes\CreateCategoryRepository;
use App\Data\Repositories\Category\Concretes\ListAllCategoryRepository;
use App\Data\Repositories\Category\Concretes\ListFindByIdCategoryRepository;
use App\Data\Repositories\Category\Concretes\UpdateCategoryRepository;

use App\Data\Repositories\Category\Interfaces\ICreateCategoryRepository;
use App\Data\Repositories\Category\Interfaces\IListAllCategoryRepository;
use App\Data\Repositories\Category\Interfaces\IListFindByIdCategoryRepository;
use App\Data\Repositories\Category\Interfaces\IUpdateCategoryRepository;

use App\Domains\Services\Category\Concretes\CreateCategoryService;
use App\Domains\Services\Category\Concretes\ListAllCategoryService;
use App\Domains\Services\Category\Concretes\ListFindByIdCategoryService;
use App\Domains\Services\Category\Concretes\UpdateCategoryService;

use App\Domains\Services\Category\Interfaces\ICreateCategoryService;
use App\Domains\Services\Category\Interfaces\IListAllCategoryService;
use App\Domains\Services\Category\Interfaces\IListFindByIdCategoryService;
use App\Domains\Services\Category\Interfaces\IUpdateCategoryService;

class CategoryDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [ICreateCategoryService::class, CreateCategoryService::class],
            [IListAllCategoryService::class, ListAllCategoryService::class],
            [IListFindByIdCategoryService::class, ListFindByIdCategoryService::class],
            [IUpdateCategoryService::class, UpdateCategoryService::class]
        ];
    }

    protected function repositories(): array
    {
        return [
            [ICreateCategoryRepository::class, CreateCategoryRepository::class],
            [IListAllCategoryRepository::class, ListAllCategoryRepository::class,],
            [IListFindByIdCategoryRepository::class, ListFindByIdCategoryRepository::class,],
            [IUpdateCategoryRepository::class, UpdateCategoryRepository::class]
        ];
    }
}
