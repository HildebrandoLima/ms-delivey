<?php

namespace App\Domains\Services\Category\Concretes;

use App\Data\Repositories\Abstracts\ICategoryRepository;
use App\Domains\Services\Category\Abstracts\IListCategoryService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Params\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListCategoryService implements IListCategoryService
{
    private ICategoryRepository $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function listCategoryAll(Request $request): Collection
    {
        $pagination = new Pagination($request);
        $search = new Search($request);
        $active = (bool) $request->active;
        if ($pagination->hasPagination($request)) {
            return $this->categoryRepository->hasPagination($search->getSearch(), $active);
        } else {
            return $this->categoryRepository->noPagination($search->getSearch(), $active);
        }
    }

    public function listCategoryFind(Request $request): Collection
    {
        return $this->categoryRepository->readOne($request->id, (bool)$request->active);
    }
}
