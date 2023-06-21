<?php

namespace App\Services\Category;

use App\DataTransferObjects\RequestsDtos\CategoryRequestDto;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Category\Interfaces\ICreateCategoryService;

class CreateCategoryService implements ICreateCategoryService
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

    public function createCategory(CategoryRequest $request): int
    {
        $this->checkEntityRepositoryInterface->checkCategoryExist($request);
        $category = CategoryRequestDto::fromRquest($request);
        return $this->categoryRepositoryInterface->create($category);
    }
}
