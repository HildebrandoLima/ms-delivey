<?php

namespace App\Services\Category\Concretes;

use App\Http\Requests\Category\ParamsCategoryRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Category\Interfaces\DeleteCategoryServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Enums\PermissionEnum;

class DeleteCategoryService extends ValidationPermission implements DeleteCategoryServiceInterface
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function deleteCategory(ParamsCategoryRequest $request): bool
    {
        $this->validationPermission(PermissionEnum::HABILITAR_DESABILITAR_CATEGORIA);
        return $this->categoryRepository->enableDisable((int)$request->id, (bool)$request->ativo);
    }
}
