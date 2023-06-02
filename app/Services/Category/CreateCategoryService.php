<?php

namespace App\Services\Category;

use App\Http\Requests\CategoryRequest;
use App\Models\Categoria;
use App\Repositories\CategoryRepository;
use App\Repositories\CheckRegisterRepository;
use App\Services\Category\Interfaces\ICreateCategoryService;
use App\Support\Utils\Enums\CategoryEnum;

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
        return $this->categoryRepository->create($category);
    }

    private function mapToModel(CategoryRequest $request): Categoria
    {
        $category = new Categoria();
        $category->descricao = $request->descricao;
        $category->ativo = CategoryEnum::ATIVADO;
        return $category;
    }
}
