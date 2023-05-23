<?php

namespace App\Services\Category;

use App\Http\Requests\CategoryRequest;
use App\Models\Categoria;
use App\Repositories\CategoryRepository;
use App\Services\Category\Interfaces\ICreateCategoryService;
use App\Support\Utils\CheckRegister\CheckCategory;

class CreateCategoryService implements ICreateCategoryService
{
    private CheckCategory $checkCcategory;
    private CategoryRepository $categoryRepository;

    public function __construct
    (
        CheckCategory      $checkCcategory,
        CategoryRepository $categoryRepository
    )
    {
        $this->checkCcategory     = $checkCcategory;
        $this->categoryRepository = $categoryRepository;
    }

    public function createCategory(CategoryRequest $request): int
    {
        $this->checkCcategory->checkCategoryExist($request);
        $category = $this->mapToModel($request);
        return $this->categoryRepository->insert($category);
    }

    private function mapToModel(CategoryRequest $request): Categoria
    {
        $category = new Categoria();
        $category->descricao = $request->descricao;
        return $category;
    }
}
