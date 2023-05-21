<?php

namespace App\Services\Product;

use App\Repositories\ProductRepository;
use App\Services\Product\Interfaces\IListProductService;
use App\Support\Utils\CheckRegister\CheckProduct;
use App\Support\Utils\CheckRegister\CheckUser;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

class ListProductService implements IListProductService
{
    private CheckProduct $checkProduct;
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

    public function listProductAll(Pagination $pagination, string $search): Collection
    {
        return $this->productRepository->getAll($pagination, $search);
    }

    public function listProductFind(int $id): Collection
    {
        $this->checkProduct->checkProductIdExist($id);
        return $this->productRepository->getFind($id);
    }
}
