<?php

namespace App\Services\Category\Concretes;

use App\Http\Requests\Category\EditCategoryRequest;
use App\Models\Categoria;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Category\Interfaces\EditCategoryServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Enums\CategoryEnum;
use App\Support\Enums\PermissionEnum;

class EditCategoryService extends ValidationPermission implements EditCategoryServiceInterface
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function editCategory(EditCategoryRequest $request): bool
    {
        $this->validationPermission(PermissionEnum::EDITAR_CATEGORIA);
        $category = $this->map($request);
        return $this->categoryRepository->update($category);
    }

    private function map(EditCategoryRequest $request): Categoria
    {
        $category = new Categoria();
        $category->id = $request->id; 
        $category->nome = $request->nome;
        $request->ativo == true ? $category->ativo = CategoryEnum::ATIVADO : $category->ativo = CategoryEnum::DESATIVADO;
        return $category;
    }
}
