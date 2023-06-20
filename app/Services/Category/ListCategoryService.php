<?php

namespace App\Services\Category;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Category\Interfaces\IListCategoryService;
use Illuminate\Support\Collection;

class ListCategoryService implements IListCategoryService
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

    public function listCategoryAll(int $active): Collection
    {
        return $this->categoryRepositoryInterface->getAll($active);
    }

    public function listProviderFind(int $id, string $search, int $active): Collection
    {
        if ($id != 0) $this->checkRegisterRepository->checkCategoryIdExist($id);
        return $this->categoryRepositoryInterface->getOne($id, $search, $active);
    }
}
