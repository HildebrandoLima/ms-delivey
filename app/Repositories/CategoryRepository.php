<?php

namespace App\Repositories;

use App\Models\Categoria;
use App\Repositories\Interfaces\ICategoryRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CategoryRepository implements ICategoryRepository {
    public function insert(Categoria $categoria): bool
    {
        return Categoria::query()->insert($categoria->toArray());
    }

    public function update(int $id, Categoria $categoria): bool
    {
        return Categoria::query()->where('id', $id)->update($categoria->toArray());
    }

    public function delete(int $id): bool
    {
        return Categoria::query()->where('id', $id)->delete();
    }

    public function getAll(string $search): Collection
    {
        $query = $this->mapToQuery();
        if (isset ($search)):
            $query->where('descricao', 'like', $search)
                  ->orderByDesc('id')->get();
        endif;
        return $query->get();
    }

    public function getFind(int $id): Collection
    {
        return $this->mapToQuery()->where('id', $id)->get();
    }

    private function mapToQuery(): Builder
    {
        return Categoria::query()->select([
            'id as descricaoId',
            'descricao as descricao',
            'created_at as criadoEm',
            'updated_at as alteradoEm'
        ]);
    }
}
