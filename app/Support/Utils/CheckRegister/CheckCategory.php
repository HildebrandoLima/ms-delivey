<?php

namespace App\Support\Utils\CheckRegister;

use App\Exceptions\HttpBadRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Categoria;

class CheckCategory
{
    public function checkCategoryExist(CategoryRequest $request): void
    {
        if (Categoria::query()
                ->where('descricao', 'like', $request->descricao)
                ->count() != 0):
            throw new HttpBadRequest('A categoria informada já existe.');
        endif;
    }

    public function checkCategoryIdExist(int $id): void
    {
        if (Categoria::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('A categoria informada não existe');
        endif;
    }
}
