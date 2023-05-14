<?php

namespace App\Repositories;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CategoryRepository {
    public function insert(Categoria $categoria): bool
    {
        return Categoria::query()->insert([
            'descricao' => $categoria->descricao,
            'created_at' => $categoria->created_at
        ]);
    }

    public function update(int $id, Categoria $categoria): bool
    {
        return Categoria::query()->where('id', $id)->update([
            'descricao' => $categoria->descricao,
            'updated_at' => $categoria->updated_at
        ]);
    }

    public function delete()
    {
        #
    }

    public function getFind(int $id): Collection
    {
        return Categoria::query()->select([
            'id as descricaoId',
            'descricao as descricao',
            'created_at as criadoEm',
            'updated_at as alteradoEm'
        ])->where('id', $id)->get();
    }

    public function getAll(string $search): Collection
    {
        $query = Categoria::query()->select([
            'id as descricaoId',
            'descricao as descricao',
            'created_at as criadoEm',
            'updated_at as alteradoEm'
        ]);
        if (isset($search)):
            $query->where('descricao', 'like', $search)->get();
        endif;
        return $query->get();
    }
}
