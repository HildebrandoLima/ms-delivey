<?php

namespace App\Data\Repositories\Product\Concretes;

use App\Data\Repositories\Product\Interfaces\IListAllProductRepository;
use App\Domains\Dtos\ProductDto;
use App\Domains\Traits\Dtos\AutoMapper;
use App\Models\Produto;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\Pagination\PaginatedList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ListAllProductRepository implements IListAllProductRepository
{
    use AutoMapper;

    public function hasPagination(string|int $search, bool $active): Collection
    {
        $collection = $this->query($search, $active)->paginate(10);
        foreach ($collection->items() as $key => $value) {
          $collection[$key] = $this->mapTo($value->toArray(), ProductDto::class);
        }
        return PaginatedList::createFromPagination($collection);
    }

    public function noPagination(string|int $search, bool $active): Collection
    {
        $collection = $this->query($search, $active)->get();
        foreach ($collection->toArray() as $key => $value) {
            $collection[$key] = $this->mapTo($value, ProductDto::class);
        }
        return $collection;
    }

    private function query(string|int $search, bool $active): Builder
    {
        return Produto::query()->with('imagem')
        ->where(function($query) use ($search, $active) {

            QueryFilter::getQueryFilter($query, $active);

            if (!empty($search)) {
                if (is_numeric($search)) {
                    $query->where('produto.categoria_id', '=', $search);
                } else {
                    $query->where('produto.nome', 'like', $search);
                }
            }
        })->orderByDesc('produto.id');
    }
}
