<?php

namespace App\Services\Product;

use App\Repositories\ProductRepository;
use App\Services\Product\Interfaces\IDeleteProductService;
use App\Support\Utils\CheckRegister\CheckProduct;

class DeleteProductService implements IDeleteProductService
{
    private CheckProduct      $checkProduct;
    private ProductRepository $productRepository;

    public function __construct
    (
        CheckProduct      $checkProduct,
        ProductRepository $productRepository
    )
    {
        $this->checkProduct      = $checkProduct;
        $this->productRepository = $productRepository;
    }

    public function deleteProduct(int $id): bool
    {
        $this->checkProduct->checkProductIdExist($id);
        return $this->productRepository->delete($id);
    }
}
