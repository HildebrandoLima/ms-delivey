<?php

namespace App\Services\Product;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Interfaces\IListProductService;
use Illuminate\Support\Collection;

class ListProductService implements IListProductService
{
    private CheckRegisterRepository    $checkRegisterRepository;
    private ProductRepositoryInterface $productRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository    $checkRegisterRepository,
        ProductRepositoryInterface $productRepositoryInterface,
    )
    {
        $this->checkRegisterRepository    = $checkRegisterRepository;
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    public function listProductAll(int $active): Collection
    {
        return $this->productRepositoryInterface->getAll($active);
    }

    public function listProductFind(int $id, string $search, int $active): Collection
    {
        if ($id != 0) $this->checkRegisterRepository->checkProductIdExist($id);
        return $this->productRepositoryInterface->getOne($id, $search, $active);
    }
}
