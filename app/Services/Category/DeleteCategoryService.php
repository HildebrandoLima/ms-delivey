<?php

namespace App\Services\Category;

use App\Repositories\CategoryRepository;
use App\Repositories\CheckRegisterRepository;
use App\Services\Category\Interfaces\IDeleteCategoryService;

class DeleteCategoryService implements IDeleteCategoryService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private CategoryRepository $categoryRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        CategoryRepository      $categoryRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->categoryRepository      = $categoryRepository;
    }

    public function deleteCategory(int $id): bool
    {
        $this->checkRegisterRepository->checkCategoryIdExist($id);
        return $this->categoryRepository->delete($id);
    }
}
