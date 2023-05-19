<?php

namespace App\Services\Category;

use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use App\Services\Category\Interfaces\IEditCategoryService;
use App\Support\Utils\CheckRegister\CheckCategory;
use App\Support\Utils\MapToModel\CategoryModel;

class EditCategoryService implements IEditCategoryService
{
    private CheckCategory $checkCategory;
    private CategoryModel $categoryModel;
    private CategoryRepository $categoryRepository;

    public function __construct
    (
        CheckCategory      $checkCategory,
        CategoryModel       $categoryModel,
        CategoryRepository $categoryRepository
    )
    {
        $this->checkCategory      = $checkCategory;
        $this->categoryModel      = $categoryModel;
        $this->categoryRepository = $categoryRepository;
    }

    public function editCategory(int $id, CategoryRequest $request): bool
    {
        $this->request = $request;
        $this->checkCategory->checkCategoryIdExist($id);
        $category = $this->categoryModel->categoryModel($request, 'edit');
        return $this->categoryRepository->update($id, $category);
    }
}
