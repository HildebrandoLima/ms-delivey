<?php

namespace App\Services\Product;

use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;
use App\Services\Product\Interfaces\ICreateProductService;
use App\Support\Utils\CheckRegister\CheckProduct;
use App\Support\Utils\CheckRegister\CheckProvider;
use App\Support\Utils\MapToModel\ProductModel;

class CreateProductService implements ICreateProductService
{
    private CheckProduct $checkProduct;
    private CheckProvider $checkProvider;
    private ProductModel $productModel;
    private ProductRepository $productRepository;

    public function __construct
    (
        CheckProduct      $checkProduct,
        CheckProvider     $checkProvider,
        ProductModel      $productModel,
        ProductRepository $productRepository
    )
    {
        $this->checkProduct      = $checkProduct;
        $this->checkProvider     = $checkProvider;
        $this->productModel      = $productModel;
        $this->productRepository = $productRepository;
    }

    public function createProduct(ProductRequest $request): int
    {
        $this->checkProduct->checkProductExist($request);
        $this->checkProvider->checkProviderIdExist($request->fornecedorId);
        $product = $this->productModel->productModel($request, 'create');
        return $this->productRepository->insert($product);
    }
}
