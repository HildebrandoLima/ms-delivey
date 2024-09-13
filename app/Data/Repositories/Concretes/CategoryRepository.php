<?php

namespace App\Data\Repositories\Concretes;

use App\Domains\Dtos\CategoryDto;
use App\Data\Repositories\Abstracts\ICategoryRepository;
use App\Domains\Traits\Dtos\AutoMapper;
use App\Models\Categoria;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CategoryRepository implements ICategoryRepository
{
    use AutoMapper;

    public function hasPagination(string $search, bool $filter): Collection
    {
        $collection = $this->query($search, 0, $filter)->paginate(10);
        foreach ($collection->items() as $key => $instance):
          $collection[$key] = $this->map($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    public function noPagination(string $search, bool $filter): Collection
    {
        $collection = $this->query($search, 0, $filter)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = $this->map($instance);
        endforeach;
        return $collection;
    }

    public function readOne(int $id, bool $filter): Collection
    {
        $collection = $this->query('', $id, $filter)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = $this->map($instance);
        endforeach;
        return $collection;
    }

    private function query(string $search, int $id, bool $filter): Builder
    {
        return Categoria::query()
        ->where(function($query) use ($search, $id, $filter) {
            QueryFilter::getQueryFilter($query, $filter);
            if (!empty($search)):
                $query->where('nome', 'like', $search);
            elseif (!empty($id)):
                $query->where('id', '=', $id);
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
