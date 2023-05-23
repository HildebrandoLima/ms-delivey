<?php

namespace App\Services\Product;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\ProductRepository;
use App\Services\Product\Interfaces\IDeleteProductService;

class DeleteProductService implements IDeleteProductService
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

    public function deleteProduct(int $id): bool
    {
        $this->checkRegisterRepository->checkProductIdExist($id);
        return $this->productRepository->delete($id);
    }
}
