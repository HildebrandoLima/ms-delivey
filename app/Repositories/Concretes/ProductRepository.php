<?php

namespace App\Repositories\Concretes;

use App\DataTransferObjects\MappersDtos\ProductMapperDto;
use App\Models\Produto;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool
    {
        return Produto::query()->where('id', '=', $id)->update(['ativo' => $active]);
    }

    public function create(Produto $produto): int
    {
        return Produto::query()->create($produto->toArray())->orderBy('id', 'desc')->first()->id;
    }

    public function update(Produto $produto): bool
    {
        return Produto::query()->where('id', '=', $produto->id)->update($produto->toArray());
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
        $collect = $this->mapToQuery()->where('produto.ativo', '=', $active)
        ->where('produto.id', '=', $id)
        ->orWhere(function ($query) use ($id) {
            $query->where('produto.categoria_id', $id);
        })->get()->toArray()[0];
        $collection = ProductMapperDto::mapper($collect);
        return collect($collection);
    }

    private function hasPagination(string $search, bool $active): Collection
    {
        $collection = $this->mapToQuery()
        ->where(function($query) use ($search, $active) {
            if(!empty($search)):
                $query->where('produto.nome', 'like', $search)->where('produto.ativo', '=', $active);
            else:
                $query->where('produto.ativo', '=', $active);
            endif;
        })->orderByDesc('produto.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = ProductMapperDto::mapper($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    private function noPagination(string $search, bool $active): Collection
    {
        $collection = $this->mapToQuery()
        ->where(function($query) use ($search, $active) {
            if(!empty($search)):
                $query->where('produto.nome', 'like', $search)->where('produto.ativo', '=', $active);
            else:
                $query->where('produto.ativo', '=', $active);
            endif;
        })->orderByDesc('produto.id')->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = ProductMapperDto::mapper($instance);
        endforeach;
        return $collection;
    }

    private function mapToQuery(): Builder
    {
        return Produto::query()->with('imagem');
    }
}
