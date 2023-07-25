<?php

namespace App\Services\Category\Concretes;

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

    public function deleteCategory(int $id, bool $active): bool
    {
        $this->validationPermission(PermissionEnum::HABILITAR_DESABILITAR_CATEGORIA);
        return $this->categoryRepository->enableDisable($id, $active);
    }
}
