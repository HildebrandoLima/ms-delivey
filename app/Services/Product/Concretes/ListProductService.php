<?php

namespace App\Services\Product\Concretes;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Interfaces\ListProductServiceInterface;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

class ListProductService implements ListProductServiceInterface
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function listProductAll(Pagination $pagination, string $search, bool $active): Collection
    {
        return $this->productRepository->getAll($pagination, $search, $active);
    }

    public function listProductFind(int $id, bool $active): Collection
    {
        return $this->productRepository->getOne($id, $active);
    }
}
