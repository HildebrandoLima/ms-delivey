<?php

namespace App\Repositories\Concretes;

use App\DataTransferObjects\MappersDtos\ProductMapperDto;
use App\Models\Produto;
use App\Repositories\Interfaces\ProductRepositoryInterface;
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

    public function update(int $id, Produto $produto): bool
    {
        return Produto::query()->where('id', '=', $id)->update($produto->toArray());
    }

    public function getAll(int $active): Collection
    {
        $collection = $this->mapToQuery()->where('produto.ativo', '=', $active)->orderByDesc('produto.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = ProductMapperDto::mapper($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    public function getOne(int $id, string $search, int $active): Collection
    {
        $collect = $this->mapToQuery()->where('produto.ativo', '=', $active)->where('produto.id', '=', $id)
        ->orWhere('produto.nome', 'like', $search)->get()->toArray()[0];
        $collection = ProductMapperDto::mapper($collect);
        return collect($collection);
    }

    private function mapToQuery(): Builder
    {
        return Produto::query()->with('imagem');
    }
}
