<?php

namespace App\Support\Utils\MapToModel;

use App\Http\Requests\CategoryRequest;
use App\Models\Categoria;

class CategoryModel {
    public function categoryModel(CategoryRequest $request): Categoria
    {
        $category = new Categoria();
        $category->descricao = $request->descricao;
        return $category;
    }
}
