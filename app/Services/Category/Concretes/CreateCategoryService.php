<?php

namespace App\Services\Category\Concretes;

use App\DataTransferObjects\RequestsDtos\CategoryRequestDto;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Category\Interfaces\CreateCategoryServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Enums\PermissionEnum;

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

    public function createCategory(CategoryRequest $request): int
    {
        $this->validationPermission(PermissionEnum::CRIAR_CATEGORIA);
        $this->checkEntityRepository->checkCategoryExist($request);
        $category = CategoryRequestDto::fromRquest($request);
        return $this->categoryRepository->create($category);
    }
}
