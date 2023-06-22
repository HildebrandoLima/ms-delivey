<?php

namespace App\Services\Category\Concretes;

use App\DataTransferObjects\RequestsDtos\CategoryRequestDto;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Category\Interfaces\EditCategoryServiceInterface;

class EditCategoryService implements EditCategoryServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;
    private CategoryRepositoryInterface    $categoryRepositoryInterface;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepositoryInterface,
        CategoryRepositoryInterface    $categoryRepositoryInterface,
    )
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
        $this->categoryRepositoryInterface    = $categoryRepositoryInterface;
    }

    public function editCategory(int $id, CategoryRequest $request): bool
    {
        $this->checkEntityRepositoryInterface->checkCategoryIdExist($id);
        $category = CategoryRequestDto::fromRquest($request);
        return $this->categoryRepositoryInterface->update($id, $category);
    }
}
