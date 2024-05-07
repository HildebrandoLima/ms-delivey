<?php

namespace App\Domains\Services\Category\Concretes;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Category\Abstracts\ICreateCategoryService;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Models\Categoria;
use App\Support\Enums\ActiveEnum;

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

    public function map(CreateCategoryRequest $request): Categoria
    {
        $category = new Categoria();
        $category->nome = $request->nome;
        $category->ativo = ActiveEnum::ATIVADO;
        return $category;
    }
}
