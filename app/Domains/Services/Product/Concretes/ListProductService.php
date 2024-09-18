<?php

namespace App\Domains\Services\Product\Concretes;

use App\Data\Repositories\Abstracts\IProductRepository;
use App\Domains\Services\Product\Abstracts\IListProductService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Params\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListProductService implements IListProductService
{
    private IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function listProductAll(Request $request): Collection
    {
        $pagination = new Pagination($request);
        $search = new Search($request);
        $active = (bool) $request->active;
        if ($pagination->hasPagination($pagination)) {
            return $this->productRepository->hasPagination($search->getSearch(), $active);
        } else {
            return $this->productRepository->noPagination($search->getSearch(), $active);
        }
    }

    public function listProductFind(Request $request): Collection
    {
        return $this->productRepository->readOne($request->id, (bool)$request->active);
    }
}
