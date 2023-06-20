<?php

namespace App\Services\Category;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Category\Interfaces\IDeleteCategoryService;

class DeleteCategoryService implements IDeleteCategoryService
{
    private CheckRegisterRepository     $checkRegisterRepository;
    private CategoryRepositoryInterface $categoryRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository     $checkRegisterRepository,
        CategoryRepositoryInterface $categoryRepositoryInterface,
    )
    {
        $this->checkRegisterRepository     = $checkRegisterRepository;
        $this->categoryRepositoryInterface = $categoryRepositoryInterface;
    }

    public function deleteCategory(int $id, int $active): bool
    {
        $this->checkRegisterRepository->checkCategoryIdExist($id);
        return $this->categoryRepositoryInterface->enableDisable($id, $active);
    }
}
