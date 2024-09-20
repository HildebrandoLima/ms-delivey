<?php

namespace App\Domains\Services\Category\Concretes;

use App\Data\Repositories\Category\Interfaces\IListAllCategoryRepository;
use App\Domains\Services\Category\Abstracts\IListCategoryService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Params\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListCategoryService implements IListCategoryService
{
    private IListAllCategoryRepository $listAllCategoryRepository;

    public function __construct(IListAllCategoryRepository $listAllCategoryRepository)
    {
        $this->listAllCategoryRepository = $listAllCategoryRepository;
    }

    public function listCategoryAll(Request $request): Collection
    {
        $pagination = new Pagination($request);
        $search = new Search($request);
        $active = (bool) $request->active;
        if ($pagination->hasPagination($request)) {
            return $this->listAllCategoryRepository->hasPagination($search->getSearch(), $active);
        } else {
            return $this->listAllCategoryRepository->noPagination($search->getSearch(), $active);
        }
    }

    public function listCategoryFind(Request $request): Collection
    {
        return collect();
    }
}
