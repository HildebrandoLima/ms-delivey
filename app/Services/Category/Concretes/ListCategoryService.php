<?php

namespace App\Services\Category\Concretes;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Category\Interfaces\ListCategoryServiceInterface;
use Illuminate\Support\Collection;

class ListCategoryService implements ListCategoryServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;
    private CategoryRepositoryInterface    $categoryRepositoryInterface;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepositoryInterface,
        CategoryRepositoryInterface    $categoryRepositoryInterface,
    )
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
        $this->categoryRepositoryInterface    = $categoryRepositoryInterface;
    }

    public function listCategoryAll(int $active): Collection
    {
        return $this->categoryRepositoryInterface->getAll($active);
    }

    public function listProviderFind(int $id, string $search, int $active): Collection
    {
        if ($id != 0) $this->checkEntityRepositoryInterface->checkCategoryIdExist($id);
        return $this->categoryRepositoryInterface->getOne($id, $search, $active);
    }
}
