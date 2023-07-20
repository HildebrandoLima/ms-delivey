<?php

namespace App\Services\Category\Concretes;

use App\Http\Requests\CategoryRequest;
use App\Models\Categoria;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Category\Interfaces\EditCategoryServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Enums\CategoryEnum;
use App\Support\Enums\PermissionEnum;

class EditCategoryService extends ValidationPermission implements EditCategoryServiceInterface
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

    public function editCategory(int $id, CategoryRequest $request): bool
    {
        $this->validationPermission(PermissionEnum::EDITAR_CATEGORIA);
        $this->checkEntityRepository->checkCategoryIdExist($id);
        $category = $this->map($request);
        return $this->categoryRepository->update($id, $category);
    }

    private function map(CategoryRequest $request): Categoria
    {
        $category = new Categoria();
        $category->nome = $request->nome;
        $request->ativo == true ? $category->ativo = CategoryEnum::ATIVADO : $category->ativo = CategoryEnum::DESATIVADO;
        return $category;
    }
}
