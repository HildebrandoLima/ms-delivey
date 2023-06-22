<?php

namespace App\Services\Product\Concretes;

use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Interfaces\DeleteProductServiceInterface;

class DeleteProductService implements DeleteProductServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;
    private ImageRepositoryInterface       $imageRepositoryInterface;
    private ProductRepositoryInterface     $productRepositoryInterface;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepositoryInterface,
        ImageRepositoryInterface       $imageRepositoryInterface,
        ProductRepositoryInterface     $productRepositoryInterface,
    )
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
        $this->imageRepositoryInterface       = $imageRepositoryInterface;
        $this->productRepositoryInterface     = $productRepositoryInterface;
    }

    public function deleteProduct(int $id, int $active): bool
    {
        $this->checkEntityRepositoryInterface->checkProductIdExist($id);
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
