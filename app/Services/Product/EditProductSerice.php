<?php

namespace App\Services\Product;

use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;
use App\Services\Product\Interfaces\IEditProductSerice;
use App\Support\Utils\CheckRegister\CheckProvider;
use App\Support\Utils\MapToModel\ProductModel;

class EditProductSerice implements IEditProductSerice
{
    private CheckProvider $checkProvider;
    private ProductModel $productModel;
    private ProductRepository $productRepository;

    public function __construct
    (
        CheckProvider     $checkProvider,
        ProductModel      $productModel,
        ProductRepository $productRepository
    )
    {
        $this->checkProvider     = $checkProvider;
        $this->productModel      = $productModel;
        $this->productRepository = $productRepository;
    }

    public function editProduct(int $id, ProductRequest $request): bool
    {
        $this->request = $request;
        $this->checkProvider->checkProviderIdExist($id);
        $provider = $this->productModel->productModel($request, 'edit');
        return $this->productRepository->update($id, $provider);
    }
}
