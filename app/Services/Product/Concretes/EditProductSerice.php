<?php

namespace App\Services\Product\Concretes;

use App\DataTransferObjects\RequestsDtos\ProductRequestDto;
use App\Http\Requests\ProductRequest;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Interfaces\EditProductSericeInterface;

class EditProductSerice implements EditProductSericeInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;
    private ProductRepositoryInterface     $productRepositoryInterface;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepositoryInterface,
        ProductRepositoryInterface     $productRepositoryInterface
    )
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
        $this->productRepositoryInterface     = $productRepositoryInterface;
    }

    public function editProduct(int $id, ProductRequest $request): bool
    {
        $this->checkEntityRepositoryInterface->checkProviderIdExist($id);
        $product = ProductRequestDto::fromRquest($request);
        return $this->productRepositoryInterface->update($id, $product);
    }
}
