<?php

namespace App\Repositories\Concretes;

use App\DataTransferObjects\MappersDtos\CategoryMapperDto;
use App\Models\Categoria;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function enableDisable(int $id, bool $active): bool
    {
        return Categoria::query()->where('id', '=', $id)->update(['ativo' => $active]);
    }

    public function create(Categoria $categoria): bool
    {
        Categoria::query()->create($categoria->toArray());
        return true;
    }

    public function update(Categoria $categoria): bool
    {
        return Categoria::query()->where('id', '=', $categoria->id)->update($categoria->toArray());
    }

    public function getAll(Pagination $pagination, string $search, bool $active): Collection
    {
        if (isset($pagination->page) && isset($pagination->perPage)):
            return $this->hasPagination($search, $active);
        else:
            return $this->noPagination($search, $active);
        endif;
    }

    public function getOne(int $id, bool $active): Collection
    {
        $collect = Categoria::query()->where('ativo', '=', $active)
        ->where('id', '=', $id)->get()->toArray()[0];
        $collection = CategoryMapperDto::mapper($collect);
        return collect($collection);
    }

    private function hasPagination(string $search, bool $active): Collection
    {
        $collection = $this->query($search, $active)->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = CategoryMapperDto::mapper($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    private function noPagination(string $search, bool $active): Collection
    {
        $collection = $this->query($search, $active)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = CategoryMapperDto::mapper($instance);
        endforeach;
        return $collection;
    }

    private function query(string $search, bool $active): Builder
    {
        return Categoria::query()
        ->where(function($query) use ($search, $active) {
            if (!empty($search)):
                $query->where('nome', 'like', $search)
                      ->where('ativo', '=', $active);
            else:
                $query->where('ativo', '=', $active);
            endif;
        })->orderByDesc('id');
    }
}
