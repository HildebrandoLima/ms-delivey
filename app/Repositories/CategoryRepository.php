<?php

namespace App\Repositories;

use App\Models\Categoria;
use App\Repositories\Interfaces\ICategoryRepository;
use App\Support\Utils\Date\DateFormat;
use App\Support\Utils\QueryBuilder\CategoryQuery;
use Illuminate\Support\Collection;

class CategoryRepository implements ICategoryRepository {
    public function insert(Categoria $categoria): bool
    {
        $resulQuery = new DateFormat();
        $categoria = $resulQuery->dateFormatDefault($categoria->toArray());
        return Categoria::query()->insert($categoria);
    }

    public function update(int $id, Categoria $categoria): bool
    {
        $resulQuery = new DateFormat();
        $categoria = $resulQuery->dateFormatDefault($categoria->toArray());
        return Categoria::query()->where('id', $id)->update($categoria);
    }

    public function delete(int $id): bool
    {
        return Categoria::query()->where('id', $id)->delete();
    }

    public function getAll(string $search): Collection
    {
        $resulQuery = new CategoryQuery();
        $query = $resulQuery->categoryQuery();
        if (isset ($search)):
            $query->where('descricao', 'like', $search)->get();
        endif;
        return $query->get();
    }

    public function getFind(int $id): Collection
    {
        $resulQuery = new CategoryQuery();
        $query = $resulQuery->categoryQuery();
        return $query->where('id', $id)->get();
    }
}
