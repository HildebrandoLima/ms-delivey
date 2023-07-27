<?php

namespace App\Services\Category\Concretes;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Models\Categoria;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Category\Interfaces\CreateCategoryServiceInterface;
use App\Support\Enums\CategoryEnum;

class CreateCategoryService implements CreateCategoryServiceInterface
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function createCategory(CreateCategoryRequest $request): bool
    {
        $category = $this->map($request);
        return $this->categoryRepository->create($category);
    }

    private function map(CreateCategoryRequest $request): Categoria
    {
        $category = new Categoria();
        $category->nome = $request->nome;
        $category->ativo = CategoryEnum::ATIVADO;
        return $category;
    }
}
