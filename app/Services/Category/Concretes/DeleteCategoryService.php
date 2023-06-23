<?php

namespace App\Services\Category\Concretes;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Category\Interfaces\DeleteCategoryServiceInterface;

class DeleteCategoryService implements DeleteCategoryServiceInterface
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

    public function deleteCategory(int $id, int $active): bool
    {
        $this->checkEntityRepository->checkCategoryIdExist($id);
        return $this->categoryRepository->enableDisable($id, $active);
    }
}
