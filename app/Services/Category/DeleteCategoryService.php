<?php

namespace App\Services\Category;

use App\Repositories\CategoryRepository;
use App\Services\Category\Interfaces\IDeleteCategoryService;
use App\Support\Utils\CheckRegister\CheckCategory;

class DeleteCategoryService implements IDeleteCategoryService
{
    private CheckCategory $checkCategory;
    private CategoryRepository $categoryRepository;

    public function __construct
    (
        CheckCategory      $checkCategory,
        CategoryRepository $categoryRepository
    )
    {
        $this->checkCategory      = $checkCategory;
        $this->categoryRepository = $categoryRepository;
    }

    public function deleteCategory(int $id): bool
    {
        $this->checkCategory->checkCategoryIdExist($id);
        return $this->categoryRepository->delete($id);
    }
}
