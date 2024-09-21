<?php

namespace App\Domains\Services\Product\Concretes;

use App\Data\Repositories\Product\Interfaces\IListAllProductRepository;
use App\Domains\Services\Product\Interfaces\IListAllProductService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Params\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListAllProductService implements IListAllProductService
{
    private IListAllProductRepository $listAllProductRepository;

    public function __construct(IListAllProductRepository $listAllProductRepository)
    {
        $this->listAllProductRepository = $listAllProductRepository;
    }

    public function listAll(Request $request): Collection
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
}
