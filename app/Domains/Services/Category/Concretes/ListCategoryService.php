<?php

namespace App\Domains\Services\Category\Concretes;

use App\Data\Repositories\Abstracts\ICategoryRepository;
use App\Domains\Services\Category\Abstracts\IListCategoryService;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

class ListCategoryService implements IListCategoryService
{
    private ICategoryRepository $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function listCategoryAll(Pagination $pagination, string $search, bool $filter): Collection
    {
        if ($pagination->hasPagination($pagination)):
            return $this->categoryRepository->hasPagination($search, $filter);
        else:
            return $this->categoryRepository->noPagination($search, $filter);
        endif;
    }

    public function listCategoryFind(int $id, bool $filter): Collection
    {
        return $this->categoryRepository->readOne($id, $filter);
    }
}
