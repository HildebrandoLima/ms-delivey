<?php

namespace App\Services\Product\Concretes;

use App\Repositories\Abstracts\IProductRepository;
use App\Services\Product\Interfaces\ListProductServiceInterface;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

class ListProductService implements ListProductServiceInterface
{
    private IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function listProductAll(Pagination $pagination, string $search, bool $filter): Collection
    {
        return $this->productRepository->readAll($pagination, $search, $filter);
    }

    public function listProductFind(int $id, bool $filter): Collection
    {
        return $this->productRepository->readOne($id, $filter);
    }
}
