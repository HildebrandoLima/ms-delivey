<?php

namespace App\Services\Product\Concretes;

use App\Data\Repositories\Abstracts\IProductRepository;
use App\Services\Product\Abstracts\IListProductService;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

class ListProductService implements IListProductService
{
    private IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function listProductAll(Pagination $pagination, string|int $search, bool $filter): Collection
    {
        return $this->productRepository->readAll($pagination, $search, $filter);
    }

    public function listProductFind(int $id, bool $filter): Collection
    {
        return $this->productRepository->readOne($id, $filter);
    }
}
