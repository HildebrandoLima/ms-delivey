<?php

namespace App\Repositories\Concretes;

use App\DataTransferObjects\MappersDtos\ProductMapperDto;
use App\Models\Produto;
use App\Repositories\Abstracts\IProductRepository;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ProductRepository implements IProductRepository
{
    public function readAll(Pagination $pagination, string $search, bool $filter): Collection
    {
        if (isset($pagination->page) && isset($pagination->perPage)):
            return $this->hasPagination($search, $filter);
        else:
            return $this->noPagination($search, $filter);
        endif;
    }

    public function readOne(int $id, bool $filter): Collection
    {
        $collection = Produto::query()->with('imagem')
        ->where(function($query) use ($filter) {
            QueryFilter::getQueryFilter($query, $filter);
        })->where('produto.id', '=', $id)
        ->orWhere(function ($query) use ($id) {
            $query->where('produto.categoria_id', $id);
        })->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = ProductMapperDto::mapper($instance);
        endforeach;
        return collect($collection);
    }

    private function hasPagination(string $search, bool $filter): Collection
    {
        $collection = $this->query($search, $filter)->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = ProductMapperDto::mapper($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    private function noPagination(string $search, bool $filter): Collection
    {
        $collection = $this->query($search, $filter)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = ProductMapperDto::mapper($instance);
        endforeach;
        return $collection;
    }

    private function query(string $search, bool $filter): Builder
    {
        return Produto::query()->with('imagem')
        ->where(function($query) use ($search, $filter) {
            QueryFilter::getQueryFilter($query, $filter);
            if (!empty($search)):
                $query->where('produto.nome', 'like', $search);
            else:
                QueryFilter::getQueryFilter($query, $filter);
            endif;
        })->orderByDesc('produto.id');
    }
}
