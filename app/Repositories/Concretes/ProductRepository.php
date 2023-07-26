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

    public function getAll(Pagination $pagination, int $active): Collection
    {
        if (isset($pagination->page) && isset($pagination->perPage)):
            return $this->hasPagination($active);
        else:
            return $this->noPagination($active);
        endif;
    }

    public function getOne(int $id, string $search, int $active): Collection
    {
        $collect = $this->mapToQuery()->where('produto.ativo', '=', $active)
        ->where('produto.id', '=', $id)
        ->orWhere(function ($query) use ($id, $search) {
            $query->where('produto.categoria_id', $id)
                  ->orWhere('produto.nome', 'like', $search);
        })->get()->toArray()[0];
        $collection = ProductMapperDto::mapper($collect);
        return collect($collection);
    }

    private function hasPagination(int $active): Collection
    {
        $collection = $this->mapToQuery()->where('produto.ativo', '=', $active)->orderByDesc('produto.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = ProductMapperDto::mapper($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    private function noPagination(int $active): Collection
    {
        $collection = $this->mapToQuery()->where('produto.ativo', '=', $active)->orderByDesc('produto.id')->get();
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
