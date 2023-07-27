<?php

namespace App\Services\Category\Concretes;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Category\Interfaces\DeleteCategoryServiceInterface;

class DeleteCategoryService implements DeleteCategoryServiceInterface
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function deleteCategory(int $id, bool $active): bool
    {
        return $this->categoryRepository->enableDisable($id, $active);
    }
}
