<?php

namespace App\Services\Category\Concretes;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Category\Interfaces\ListCategoryServiceInterface;
use App\Support\Enums\PermissionEnum;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

class ListCategoryService extends ValidationPermission implements ListCategoryServiceInterface
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct
    (
        CategoryRepositoryInterface $categoryRepository,
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function listCategoryAll(Pagination $pagination, string $search, bool $active): Collection
    {
        return $this->categoryRepository->getAll($pagination, $search, $active);
    }

    public function listCategoryFind(int $id, bool $active): Collection
    {
        $this->validationPermission(PermissionEnum::LISTAR_DETALHES_CATEGORIA);
        return $this->categoryRepository->getOne($id, $active);
    }
}
