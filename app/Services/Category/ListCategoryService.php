<?php

namespace App\Services\Category;

use App\Repositories\CategoryRepository;
use App\Services\Category\Interfaces\IListCategoryService;
use App\Support\Utils\CheckRegister\CheckCategory;
use Illuminate\Support\Collection;

class ListCategoryService implements IListCategoryService
{
    private CheckCategory $checkCategory;
    private CategoryRepository $categoryRepository;

    public function __construct
    (
        CheckCategory      $checkCategory,
        CategoryRepository $categoryRepository
    )
    {
        $this->checkCategory      = $checkCategory;
        $this->categoryRepository = $categoryRepository;
    }

    public function listCategoryAll(string $search): Collection
    {
        return $this->categoryRepository->getAll($search);
    }

    public function listProviderFind(int $id): Collection
    {
        $this->checkCategory->checkCategoryIdExist($id);
        return $this->categoryRepository->getFind($id);
    }
}
