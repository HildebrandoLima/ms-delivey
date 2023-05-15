<?php

namespace App\Services\Category;

use App\Exceptions\HttpBadRequest;
use App\Models\Categoria;
use App\Models\Fornecedor;
use App\Repositories\CategoryRepository;
use App\Repositories\ProviderRepository;

class DeleteCategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function deleteCategory(int $id): bool
    {
        $this->checkCategory($id);
        return $this->categoryRepository->delete($id);
    }

    private function checkCategory(int $id): void
    {
        if (Categoria::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('A categoria não existe');
        endif;
    }
}