<?php

namespace App\Repositories;

use App\Models\Categoria;

class CategoryRepository {
    public function insert(Categoria $categoria): bool
    {
        return Categoria::query()->insert([
            'descricao' => $categoria->descricao,
            'created_at' => $categoria->created_at
        ]);
    }

    public function update()
    {
        #
    }

    public function delete()
    {
        #
    }

    public function getFind()
    {
        #
    }

    public function getAll()
    {
        #
    }
}
