<?php

namespace App\Services\Category;

use App\Exceptions\HttpBadRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Categoria;
use App\Repositories\CategoryRepository;
use App\Services\Category\Interfaces\ICreateCategoryService;
use DateTime;

class CreateCategoryService implements ICreateCategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function createCategory(CategoryRequest $request): int
    {
        $this->request = $request;
        $this->checkCategory();
        $category = $this->mapToModel();
        return $this->categoryRepository->insert($category);
    }

    private function checkCategory(): void
    {
        if (!Categoria::query()
                ->where('descricao', 'like', $this->request->descricao)->count() == 0):
            throw new HttpBadRequest('A categoria já existe');
        endif;
    }

    private function mapToModel(): Categoria
    {
        $category = new Categoria();
        $category->descricao = $this->request->descricao;
        $category->created_at = new DateTime();
        return $category;
    }
}
