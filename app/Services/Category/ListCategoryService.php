<?php

namespace App\Services\Category;

use App\Repositories\CategoryRepository;
use Illuminate\Support\Collection;

class ListCategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function listCategoryAll(string $search): Collection
    {
        return $this->categoryRepository->getAll($search);
    }

    public function listProviderFind(int $id): Collection
    {
        return $this->categoryRepository->getFind($id);
    }
}
