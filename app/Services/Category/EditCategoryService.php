<?php

namespace App\Services\Category;

use App\Http\Requests\CategoryRequest;
use App\Models\Categoria;
use App\Repositories\CategoryRepository;
use App\Services\Category\Interfaces\IEditCategoryService;
use App\Support\Utils\CheckRegister\CheckCategory;
use DateTime;

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
        $category = $this->mapToModel();
        return $this->categoryRepository->update($id, $category);
    }

    private function mapToModel(): Categoria
    {
        $category = new Categoria();
        $category->descricao = $this->request->descricao;
        $category->updated_at = new DateTime();
        return $category;
    }
}
