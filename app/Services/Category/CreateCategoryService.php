<?php

namespace App\Services\Category;

use App\Http\Requests\CategoryRequest;
use App\Models\Categoria;
use App\Repositories\CategoryRepository;
use App\Services\Category\Interfaces\ICreateCategoryService;
use App\Support\Utils\CheckRegister\CheckCategory;
use DateTime;

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
        $this->request = $request;
        $this->checkCcategory->checkCategoryExist($request);
        $category = $this->mapToModel();
        return $this->categoryRepository->insert($category);
    }

    private function mapToModel(): Categoria
    {
        $category = new Categoria();
        $category->descricao = $this->request->descricao;
        $category->created_at = new DateTime();
        return $category;
    }
}
