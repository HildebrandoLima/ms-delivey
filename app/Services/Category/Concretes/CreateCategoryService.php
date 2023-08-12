<?php

namespace App\Services\Category\Concretes;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Models\Categoria;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Category\Abstracts\ICreateCategoryService;
use App\Support\Enums\AtivoEnum;

class CreateCategoryService implements ICreateCategoryService
{
    private IEntityRepository $categoryRepository;

    public function __construct(IEntityRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function createCategory(CreateCategoryRequest $request): bool
    {
        $category = $this->map($request);
        return $this->categoryRepository->create($category);
    }

    private function map(CreateCategoryRequest $request): Categoria
    {
        $category = new Categoria();
        $category->nome = $request->nome;
        $category->ativo = AtivoEnum::ATIVADO;
        return $category;
    }
}
