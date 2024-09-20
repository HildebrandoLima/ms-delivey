<?php

namespace App\Data\Repositories\Category\Concretes;

use App\Data\Repositories\Category\Interfaces\IListAllCategoryRepository;
use App\Domains\Dtos\CategoryDto;
use App\Domains\Traits\Dtos\AutoMapper;
use App\Models\Categoria;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\Pagination\PaginatedList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ListAllCategoryRepository implements IListAllCategoryRepository
{
    use AutoMapper;

    public function hasPagination(string $search, bool $active): Collection
    {
        $collection = $this->query($search, $active)->paginate(10);
        foreach ($collection->items() as $key => $value) {
          $collection[$key] = $this->map($value->toArray());
        }
        return PaginatedList::createFromPagination($collection);
    }

    public function noPagination(string $search, bool $active): Collection
    {
        $collection = $this->query($search, $active)->get();
        foreach ($collection->toArray() as $key => $value) {
            $collection[$key] = $this->map($value);
        }
        return $collection;
    }

    private function query(string $search, bool $active): Builder
    {
        return Categoria::query()
        ->where(function($query) use ($search, $active) {

            QueryFilter::getQueryFilter($query, $active);

            if (!empty($search)) {
                $query->where('nome', 'like', $search);
            }
        })->orderByDesc('id');
    }

    private function map(array $data): CategoryDto
    {
        return $this->mapper($data, CategoryDto::class);
    }
}
