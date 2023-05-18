<?php

namespace App\Support\Utils\QueryBuilder;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Builder;

class CategoryQuery {
    public function categoryQuery(): Builder
    {
        return Categoria::query()->select([
            'id as descricaoId',
            'descricao as descricao',
            'created_at as criadoEm',
            'updated_at as alteradoEm'
        ]);
    }
}
