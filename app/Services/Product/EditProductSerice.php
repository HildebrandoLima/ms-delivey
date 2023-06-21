<?php

namespace App\Services\Product;

use App\DataTransferObjects\RequestsDtos\ProductRequestDto;
use App\Http\Requests\ProductRequest;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Interfaces\IEditProductSerice;

class EditProductSerice implements IEditProductSerice
{
    private CheckRegisterRepository    $checkRegisterRepository;
    private ProductRepositoryInterface $productRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository    $checkRegisterRepository,
        ProductRepositoryInterface $productRepositoryInterface
    )
    {
        $this->checkRegisterRepository    = $checkRegisterRepository;
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    public function editProduct(int $id, ProductRequest $request): bool
    {
        $this->checkRegisterRepository->checkProviderIdExist($id);
        $product = ProductRequestDto::fromRquest($request);
        return $this->productRepositoryInterface->update($id, $product);
    }
}
