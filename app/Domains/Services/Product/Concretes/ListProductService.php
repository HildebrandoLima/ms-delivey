<?php

namespace App\Domains\Services\Product\Concretes;

use App\Data\Repositories\Product\Interfaces\IListAllProductRepository;
use App\Domains\Services\Product\Abstracts\IListProductService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Params\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListProductService implements IListProductService
{
    private IListAllProductRepository $listAllProductRepository;

    public function __construct(IListAllProductRepository $listAllProductRepository)
    {
        $this->listAllProductRepository = $listAllProductRepository;
    }

    public function listProductAll(Request $request): Collection
    {
        $pagination = new Pagination($request);
        $search = new Search($request);
        $active = (bool) $request->active;
        if ($pagination->hasPagination($pagination)) {
            return $this->listAllProductRepository->hasPagination($search->getSearch(), $active);
        } else {
            return $this->listAllProductRepository->noPagination($search->getSearch(), $active);
        }
    }

    public function listProductFind(Request $request): Collection
    {
        return collect();
        //$this->productRepository->readOne($request->id, (bool)$request->active);
    }
}
