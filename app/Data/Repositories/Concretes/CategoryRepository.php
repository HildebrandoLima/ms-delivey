<?php

namespace App\Data\Repositories\Concretes;

use App\Domains\Dtos\CategoryDto;
use App\Data\Repositories\Abstracts\ICategoryRepository;
use App\Domains\Traits\Dtos\AutoMapper;
use App\Models\Categoria;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CategoryRepository implements ICategoryRepository
{
    use AutoMapper;

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
        $collection = Categoria::query()
        ->where(function($query) use ($filter){
            QueryFilter::getQueryFilter($query, $filter);
        })->where('id', '=', $id)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = $this->map($instance);
        endforeach;
        return $collection;
    }

    private function hasPagination(string $search, bool $filter): Collection
    {
        $collection = $this->query($search, $filter)->paginate(10);
        foreach ($collection->items() as $key => $instance):
          $collection[$key] = $this->map($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    private function noPagination(string $search, bool $filter): Collection
    {
        $collection = $this->query($search, $filter)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = $this->map($instance);
        endforeach;
        return $collection;
    }

    private function query(string $search, bool $filter): Builder
    {
        return Categoria::query()
        ->where(function($query) use ($search, $filter) {
            QueryFilter::getQueryFilter($query, $filter);
            if (!empty($search)):
                $query->where('nome', 'like', $search);
            else:
                QueryFilter::getQueryFilter($query, $filter);
            endif;
        })->orderByDesc('id');
    }

    private function map(array $data): CategoryDto
    {
        return $this->mapper($data, CategoryDto::class);
    }
}
