<?php

namespace App\Services\Product;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Interfaces\IDeleteProductService;

class DeleteProductService implements IDeleteProductService
{
    private CheckRegisterRepository    $checkRegisterRepository;
    private ImageRepositoryInterface   $imageRepositoryInterface;
    private ProductRepositoryInterface $productRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository    $checkRegisterRepository,
        ImageRepositoryInterface   $imageRepositoryInterface,
        ProductRepositoryInterface $productRepositoryInterface,
    )
    {
        $this->checkRegisterRepository    = $checkRegisterRepository;
        $this->imageRepositoryInterface   = $imageRepositoryInterface;
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    public function deleteProduct(int $id, int $active): bool
    {
        $this->checkRegisterRepository->checkProductIdExist($id);
        if
        (
            $this->imageRepositoryInterface->enableDisable($id, $active)
            and
            $this->productRepositoryInterface->enableDisable($id, $active)
        ):
            return true;
        else:
            return false;
        endif;
    }
}
