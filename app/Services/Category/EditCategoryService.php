<?php

namespace App\Services\Category;

use App\Http\Requests\CategoryRequest;
use App\Models\Categoria;
use App\Repositories\CategoryRepository;
use DateTime;

class EditCategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function editCategory(int $id, CategoryRequest $request): bool
    {
        $this->request = $request;
        $category = $this->mapToModel();
        return $this->categoryRepository->update($id, $category);
    }

    private function mapToModel(): Categoria
    {
        $category = new Categoria();
        $category->descricao = $this->request->descricao;
        $category->updated_at = new DateTime();
        return $category;
    }
}
