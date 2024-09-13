<?php

namespace App\Domains\Services\Product\Concretes;

use App\Data\Repositories\Abstracts\IProductRepository;
use App\Domains\Services\Product\Abstracts\IListProductService;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

class ListProductService implements IListProductService
{
    private IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function listProductAll(Pagination $pagination, string|int $search, bool $filter): Collection
    {
        if ($pagination->hasPagination($pagination)):
            return $this->productRepository->hasPagination($search, $filter);
        else:
            return $this->productRepository->noPagination($search, $filter);
        endif;
    }

    public function listProductFind(int $id, bool $filter): Collection
    {
        return $this->productRepository->readOne($id, $filter);
    }
}
