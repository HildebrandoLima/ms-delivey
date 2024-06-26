<?php

namespace App\Domains\Services\Category\Concretes;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Category\Abstracts\IEditCategoryService;
use App\Http\Requests\Category\EditCategoryRequest;
use App\Models\Categoria;
use App\Support\Enums\ActiveEnum;

class EditCategoryService implements IEditCategoryService
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

    public function map(EditCategoryRequest $request): Categoria
    {
        $category = new Categoria();
        $category->id = $request->id;
        $category->nome = $request->nome;
        $category->ativo = $request->ativo == true ? ActiveEnum::ATIVADO : ActiveEnum::DESATIVADO;
        return $category;
    }
}
