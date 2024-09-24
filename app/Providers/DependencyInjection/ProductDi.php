<?php

namespace App\Providers\DependencyInjection;

use App\Data\Repositories\Product\Concretes\CreateProductRepository;
use App\Data\Repositories\Product\Concretes\ListAllProductRepository;
use App\Data\Repositories\Product\Concretes\ListFindByIdProductRepository;
use App\Data\Repositories\Product\Concretes\UpdateProductRepository;

use App\Data\Repositories\Product\Interfaces\ICreateProductRepository;
use App\Data\Repositories\Product\Interfaces\IListAllProductRepository;
use App\Data\Repositories\Product\Interfaces\IListFindByIdProductRepository;
use App\Data\Repositories\Product\Interfaces\IUpdateProductRepository;

use App\Domains\Services\Product\Concretes\CreateProductService;
use App\Domains\Services\Product\Concretes\ListAllProductService;
use App\Domains\Services\Product\Concretes\ListFindByIdProductService;
use App\Domains\Services\Product\Concretes\UpdateProductService;

use App\Domains\Services\Product\Interfaces\ICreateProductService;
use App\Domains\Services\Product\Interfaces\IListAllProductService;
use App\Domains\Services\Product\Interfaces\IListFindByIdProductService;
use App\Domains\Services\Product\Interfaces\IUpdateProductService;

class ProductDi extends DependencyInjection
{

    protected function services(): array
    {
        return [
            [ICreateProductService::class, CreateProductService::class],
            [IListAllProductService::class, ListAllProductService::class],
            [IListFindByIdProductService::class, ListFindByIdProductService::class],
            [IUpdateProductService::class, UpdateProductService::class]
        ];
    }

    protected function repositories(): array
    {
        return [
            [ICreateProductRepository::class, CreateProductRepository::class],
            [IListAllProductRepository::class, ListAllProductRepository::class],
            [IListFindByIdProductRepository::class, ListFindByIdProductRepository::class],
            [IUpdateProductRepository::class, UpdateProductRepository::class]
        ];
    }
}
