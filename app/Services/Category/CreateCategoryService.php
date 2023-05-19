<?php

namespace App\Services\Category;

use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use App\Services\Category\Interfaces\ICreateCategoryService;
use App\Support\Utils\CheckRegister\CheckCategory;
use App\Support\Utils\MapToModel\CategoryModel;

class CreateCategoryService implements ICreateCategoryService
{
    private CheckCategory $checkCcategory;
    private CategoryModel $categoryModel;
    private CategoryRepository $categoryRepository;

    public function __construct
    (
        CheckCategory      $checkCcategory,
        CategoryModel      $categoryModel,
        CategoryRepository $categoryRepository
    )
    {
        $this->checkCcategory     = $checkCcategory;
        $this->categoryModel      = $categoryModel;
        $this->categoryRepository = $categoryRepository;
    }

    public function createCategory(CategoryRequest $request): int
    {
        $this->checkCcategory->checkCategoryExist($request);
        $category = $this->categoryModel->categoryModel($request, 'create');
        return $this->categoryRepository->insert($category);
    }
}
