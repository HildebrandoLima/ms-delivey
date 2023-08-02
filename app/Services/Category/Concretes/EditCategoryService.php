<?php

namespace App\Services\Category\Concretes;

use App\Http\Requests\Category\EditCategoryRequest;
use App\Models\Categoria;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Category\Interfaces\EditCategoryServiceInterface;
use App\Support\Enums\AtivoEnum;

class EditCategoryService implements EditCategoryServiceInterface
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function editCategory(EditCategoryRequest $request): bool
    {
        $category = $this->map($request);
        return $this->categoryRepository->update($category);
    }

    private function map(EditCategoryRequest $request): Categoria
    {
        $category = new Categoria();
        $category->id = $request->id; 
        $category->nome = $request->nome;
        $category->ativo = $request->ativo == true ? AtivoEnum::ATIVADO : AtivoEnum::DESATIVADO;
        return $category;
    }
}
