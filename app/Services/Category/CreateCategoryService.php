<?php

namespace App\Services\Category;

use App\Http\Requests\CategoryRequest;
use App\Models\Categoria;
use App\Repositories\CategoryRepository;
use App\Repositories\CheckRegisterRepository;
use App\Services\Category\Interfaces\ICreateCategoryService;

class CreateCategoryService implements ICreateCategoryService
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

    public function createCategory(CategoryRequest $request): int
    {
        $this->checkRegisterRepository->checkCategoryExist($request);
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
