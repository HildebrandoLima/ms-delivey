<?php

namespace App\Services\Category\Concretes;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Category\Interfaces\ListCategoryServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Enums\PermissionEnum;
use Illuminate\Support\Collection;

class ListCategoryService extends ValidationPermission implements ListCategoryServiceInterface
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

    public function listCategoryAll(int $active): Collection
    {
        $this->validationPermission(PermissionEnum::LISTAR_CATEGORIA);
        return $this->categoryRepository->getAll($active);
    }

    public function listProviderFind(int $id, string $search, int $active): Collection
    {
        $this->validationPermission(PermissionEnum::LISTAR_CATEGORIA);
        if ($id != 0) $this->checkEntityRepository->checkCategoryIdExist($id);
        return $this->categoryRepository->getOne($id, $search, $active);
    }
}
