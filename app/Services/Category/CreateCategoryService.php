<?php

namespace App\Services\Category;

use App\DataTransferObjects\RequestsDtos\CategoryRequestDto;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Category\Interfaces\ICreateCategoryService;

class CreateCategoryService implements ICreateCategoryService
{
    private CheckRegisterRepository     $checkRegisterRepository;
    private CategoryRepositoryInterface $categoryRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository     $checkRegisterRepository,
        CategoryRepositoryInterface $categoryRepositoryInterface,
    )
    {
        $this->checkRegisterRepository     = $checkRegisterRepository;
        $this->categoryRepositoryInterface = $categoryRepositoryInterface;
    }

    public function createCategory(CategoryRequest $request): int
    {
        $this->checkRegisterRepository->checkCategoryExist($request);
        $category = CategoryRequestDto::fromRquest($request);
        return $this->categoryRepositoryInterface->create($category);
    }
}
