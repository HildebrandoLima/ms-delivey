<?php

namespace App\Repositories\Concretes;

use App\DataTransferObjects\MappersDtos\CategoryMapperDto;
use App\Models\Categoria;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool
    {
        return Categoria::query()->where('id', '=', $id)->update(['ativo' => $active]);
    }

    public function create(Categoria $categoria): bool
    {
        Categoria::query()->create($categoria->toArray());
        return true;
    }

    public function update(int $id, Categoria $categoria): bool
    {
        return Categoria::query()->where('id', '=', $id)->update($categoria->toArray());
    }

    public function getAll(int $active): Collection
    {
        $collection = $this->mapToQuery()->where('ativo', '=', $active)->orderByDesc('id')->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = CategoryMapperDto::mapper($instance);
        endforeach;
        return $collection;
    }

    public function getOne(int $id, string $search, int $active): Collection
    {
        $collect = $this->mapToQuery()->where('ativo', $active)->where('id', '=', $id)
        ->orWhere('nome', 'like', $search)->get()->toArray()[0];
        $collection = CategoryMapperDto::mapper($collect);
        return collect($collection);
    }

    private function mapToQuery(): Builder
    {
        return Categoria::query();
    }
}
