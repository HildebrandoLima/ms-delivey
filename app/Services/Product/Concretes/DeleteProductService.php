<?php

namespace App\Services\Product\Concretes;

use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Interfaces\DeleteProductServiceInterface;

class DeleteProductService implements DeleteProductServiceInterface
{
    private ImageRepositoryInterface       $imageRepository;
    private ProductRepositoryInterface     $productRepository;

    public function __construct
    (
        ImageRepositoryInterface       $imageRepository,
        ProductRepositoryInterface     $productRepository,
    )
    {
        $this->imageRepository       = $imageRepository;
        $this->productRepository     = $productRepository;
    }

    public function deleteProduct(int $id, bool $active): bool
    {
        if
        (
            $this->imageRepository->enableDisable($id, $active)
            and
            $this->productRepository->enableDisable($id, $active)
        ):
            return true;
        else:
            return false;
        endif;
    }
}
