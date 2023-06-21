<?php

namespace App\Services\Category;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Category\Interfaces\IDeleteCategoryService;

class DeleteCategoryService implements IDeleteCategoryService
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

    public function deleteCategory(int $id, int $active): bool
    {
        $this->checkEntityRepositoryInterface->checkCategoryIdExist($id);
        return $this->categoryRepositoryInterface->enableDisable($id, $active);
    }
}
