<?php

namespace App\Services\Category\Concretes;

use App\Http\Requests\CategoryRequest;
use App\Models\Categoria;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Category\Interfaces\CreateCategoryServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Enums\CategoryEnum;
use App\Support\Enums\PermissionEnum;

class CreateCategoryService extends ValidationPermission implements CreateCategoryServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private CategoryRepositoryInterface    $categoryRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        CategoryRepositoryInterface    $categoryRepository,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->categoryRepository    = $categoryRepository;
    }

    public function createCategory(CategoryRequest $request): bool
    {
        $this->validationPermission(PermissionEnum::CRIAR_CATEGORIA);
        $this->checkEntityRepository->checkCategoryExist($request);
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
