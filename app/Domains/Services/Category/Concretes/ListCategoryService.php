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
        return $this->categoryRepository->readAll($pagination, $search, $filter);
    }

    public function listCategoryFind(int $id, bool $filter): Collection
    {
        return $this->categoryRepository->readOne($id, $filter);
    }
}
