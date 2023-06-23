<?php

namespace App\Services\Category\Concretes;

use App\DataTransferObjects\RequestsDtos\CategoryRequestDto;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Category\Interfaces\EditCategoryServiceInterface;

class EditCategoryService implements EditCategoryServiceInterface
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
        $this->checkEntityRepository->checkCategoryIdExist($id);
        $category = CategoryRequestDto::fromRquest($request);
        return $this->categoryRepository->update($id, $category);
    }
}
