<?php

namespace App\Services\Category\Concretes;

use App\Http\Requests\Category\CategoryRequest;
use App\Models\Categoria;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Category\Interfaces\CreateCategoryServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Enums\CategoryEnum;
use App\Support\Enums\PermissionEnum;

class CreateCategoryService extends ValidationPermission implements CreateCategoryServiceInterface
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function createCategory(CategoryRequest $request): bool
    {
        $this->validationPermission(PermissionEnum::CRIAR_CATEGORIA);
        $category = $this->map($request);
        return $this->categoryRepository->create($category);
    }

    private function map(CategoryRequest $request): Categoria
    {
        $category = new Categoria();
        $category->nome = $request->nome;
        $category->ativo = CategoryEnum::ATIVADO;
        return $category;
    }
}
