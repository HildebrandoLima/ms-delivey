<?php

namespace App\Services\Category;

use App\Repositories\CategoryRepository;
use App\Repositories\CheckRegisterRepository;
use App\Services\Category\Interfaces\IListCategoryService;
use Illuminate\Support\Collection;

class ListCategoryService implements IListCategoryService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private CategoryRepository $categoryRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        CategoryRepository      $categoryRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->categoryRepository      = $categoryRepository;
    }

    public function listCategoryAll(string $search): Collection
    {
        return $this->categoryRepository->getAll($search);
    }

    public function listProviderFind(int $id): Collection
    {
        $this->checkRegisterRepository->checkCategoryIdExist($id);
        return $this->categoryRepository->getFind($id);
    }
}
