<?php

namespace App\Services\Product;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\ProductRepository;
use App\Services\Product\Interfaces\IListProductService;
use Illuminate\Support\Collection;

class ListProductService implements IListProductService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private ProductRepository $productRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        ProductRepository       $productRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->productRepository       = $productRepository;
    }

    public function listProductAll(int $active): Collection
    {
        return $this->productRepository->getAll($active);
    }

    public function listProductFind(int $id, string $search, int $active): Collection
    {
        if ($id != 0) $this->checkRegisterRepository->checkProductIdExist($id);
        return $this->productRepository->getFind($id, $search, $active);
    }
}
