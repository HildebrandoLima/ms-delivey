<?php

namespace App\Services\Product\Concretes;

use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Interfaces\ListProductServiceInterface;
use Illuminate\Support\Collection;

class ListProductService implements ListProductServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;
    private ProductRepositoryInterface     $productRepositoryInterface;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepositoryInterface,
        ProductRepositoryInterface     $productRepositoryInterface,
    )
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
        $this->productRepositoryInterface     = $productRepositoryInterface;
    }

    public function listProductAll(int $active): Collection
    {
        return $this->productRepositoryInterface->getAll($active);
    }

    public function listProductFind(int $id, string $search, int $active): Collection
    {
        if ($id != 0) $this->checkEntityRepositoryInterface->checkProductIdExist($id);
        return $this->productRepositoryInterface->getOne($id, $search, $active);
    }
}
