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

    public function listCategoryAll(int $active): Collection
    {
        return $this->categoryRepository->getAll($active);
    }

    public function listProviderFind(int $id, string $search, int $active): Collection
    {
        if ($id != 0):
            $this->checkRegisterRepository->checkCategoryIdExist($id);
        endif;
        return $this->categoryRepository->getFind($id, $search, $active);
    }
}
