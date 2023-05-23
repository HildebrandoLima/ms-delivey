<?php

namespace App\Services\Product;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\ProductRepository;
use App\Services\Product\Interfaces\IListProductService;
use App\Support\Utils\Pagination\Pagination;
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

    public function listProductAll(Pagination $pagination, string $search): Collection
    {
        return $this->productRepository->getAll($pagination, $search);
    }

    public function listProductFind(int $id): Collection
    {
        $this->checkRegisterRepository->checkProductIdExist($id);
        return $this->productRepository->getFind($id);
    }
}
