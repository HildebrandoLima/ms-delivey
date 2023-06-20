<?php

namespace App\Services\Category;

use App\DataTransferObjects\RequestsDtos\CategoryRequestDto;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Category\Interfaces\IEditCategoryService;

class EditCategoryService implements IEditCategoryService
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

    public function editCategory(int $id, CategoryRequest $request): bool
    {
        $this->checkRegisterRepository->checkCategoryIdExist($id);
        $category = CategoryRequestDto::fromRquest($request);
        return $this->categoryRepositoryInterface->update($id, $category);
    }
}
