<?php

namespace App\Support\Utils\MapToModel;

use App\Http\Requests\CategoryRequest;
use App\Models\Categoria;
use DateTime;

class CategoryModel {
    public function categoryModel(CategoryRequest $request, string $method): Categoria
    {
        $category = new Categoria();
        $category->descricao = $request->descricao;
        $method == 'create' ? $category->created_at = new DateTime() : $category->updated_at = new DateTime();
        return $category;
    }
}
