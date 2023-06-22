<?php

namespace App\Services\Product\Concretes;

use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Interfaces\DeleteProductServiceInterface;

class DeleteProductService implements DeleteProductServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private ImageRepositoryInterface       $imageRepository;
    private ProductRepositoryInterface     $productRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        ImageRepositoryInterface       $imageRepository,
        ProductRepositoryInterface     $productRepository,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->imageRepository       = $imageRepository;
        $this->productRepository     = $productRepository;
    }

    public function deleteProduct(int $id, int $active): bool
    {
        $this->checkEntityRepository->checkProductIdExist($id);
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
