<?php

namespace App\Services\Product;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\ImageRepository;
use App\Repositories\ProductRepository;
use App\Services\Product\Interfaces\IDeleteProductService;

class DeleteProductService implements IDeleteProductService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private ImageRepository $imageRepository;
    private ProductRepository $productRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        ImageRepository         $imageRepository,
        ProductRepository       $productRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->imageRepository         = $imageRepository;
        $this->productRepository       = $productRepository;
    }

    public function deleteProduct(int $id, int $active): bool
    {
        $this->checkRegisterRepository->checkProductIdExist($id);
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
