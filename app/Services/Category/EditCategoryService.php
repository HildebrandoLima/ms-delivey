<?php

namespace App\Services\Category;

use App\Http\Requests\CategoryRequest;
use App\Models\Categoria;
use App\Repositories\CategoryRepository;
use App\Services\Category\Interfaces\IEditCategoryService;
use App\Support\Utils\CheckRegister\CheckCategory;

class EditCategoryService implements IEditCategoryService
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

    public function editCategory(int $id, CategoryRequest $request): bool
    {
        $this->request = $request;
        $this->checkCategory->checkCategoryIdExist($id);
        $category = $this->mapToModel($request);
        return $this->categoryRepository->update($id, $category);
    }

    private function mapToModel(CategoryRequest $request): Categoria
    {
        $category = new Categoria();
        $category->descricao = $request->descricao;
        return $category;
    }
}
