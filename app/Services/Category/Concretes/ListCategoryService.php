<?php

namespace App\Services\Category\Concretes;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Category\Interfaces\ListCategoryServiceInterface;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

class ListCategoryService implements ListCategoryServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private CategoryRepositoryInterface    $categoryRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        CategoryRepositoryInterface    $categoryRepository,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->categoryRepository    = $categoryRepository;
    }

    public function listCategoryAll(Pagination $pagination, int $active): Collection
    {
        return $this->categoryRepository->getAll($pagination, $active);
    }

    public function listCategoryFind(int $id, string $search, int $active): Collection
    {
        if ($id != 0) $this->checkEntityRepository->checkCategoryIdExist($id);
        return $this->categoryRepository->getOne($id, $search, $active);
    }
}
