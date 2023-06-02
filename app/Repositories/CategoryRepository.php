<?php

namespace App\Repositories;

use App\Models\Categoria;
use App\Repositories\Interfaces\ICategoryRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CategoryRepository implements ICategoryRepository {
    public function insert(Categoria $categoria): bool
    {
        Categoria::query()->create($categoria->toArray());
        return true;
    }

    public function update(int $id, Categoria $categoria): bool
    {
        return Categoria::query()->where('id', $id)->update($categoria->toArray());
    }

    public function delete(int $id): bool
    {
        return Categoria::query()->where('id', $id)->delete();
    }

    public function getAll(int $active): Collection
    {
        return $this->mapToQuery()->where('ativo', $active)->orderByDesc('id')->get();
    }

    public function getFind(int $id, string $search, int $active): Collection
    {
        return $this->mapToQuery()
        ->where('ativo', $active)->where('id', $id)
        ->orWhere('descricao', 'like', $search)->get();
    }

    private function mapToQuery(): Builder
    {
        return Categoria::query()->select([
            'id as descricaoId',
            'descricao as descricao',
            'ativo as ativo',
            'created_at as criadoEm',
            'updated_at as alteradoEm'
        ]);
    }
}
