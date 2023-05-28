<?php

namespace App\Services\Category;

use App\Http\Requests\CategoryRequest;
use App\Models\Categoria;
use App\Repositories\CategoryRepository;
use App\Repositories\CheckRegisterRepository;
use App\Services\Category\Interfaces\IEditCategoryService;
use App\Support\Utils\Enums\CategoryEnum;

class EditCategoryService implements IEditCategoryService
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

    public function editCategory(int $id, CategoryRequest $request): bool
    {
        $this->request = $request;
        $this->checkRegisterRepository->checkCategoryIdExist($id);
        $category = $this->mapToModel($request);
        return $this->categoryRepository->update($id, $category);
    }

    private function mapToModel(CategoryRequest $request): Categoria
    {
        $category = new Categoria();
        $category->descricao = $request->descricao;
        $request->ativo == 1 ? $category->ativo = CategoryEnum::ATIVADO : $category->ativo = CategoryEnum::DESATIVADO;
        return $category;
    }
}
