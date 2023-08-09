<?php

namespace App\Services\Category\Concretes;

use App\Http\Requests\Category\EditCategoryRequest;
use App\Models\Categoria;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Category\Interfaces\EditCategoryServiceInterface;

class EditCategoryService implements EditCategoryServiceInterface
{
    private IEntityRepository $categoryRepository;

    public function __construct(IEntityRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function editCategory(EditCategoryRequest $request): bool
    {
        $category = $this->map($request);
        return $this->categoryRepository->update($category);
    }

    private function map(EditCategoryRequest $request): Categoria
    {
        $category = new Categoria();
        $category->id = $request->id; 
        $category->nome = $request->nome;
        return $category;
    }
}
