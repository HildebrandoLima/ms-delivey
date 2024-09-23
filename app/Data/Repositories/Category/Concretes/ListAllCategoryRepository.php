<?php

namespace App\Data\Repositories\Category\Concretes;

use App\Data\Repositories\Category\Interfaces\IListAllCategoryRepository;
use App\Models\Categoria;
use App\Support\Queries\QueryFilter;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ListAllCategoryRepository implements IListAllCategoryRepository
{
    public function hasPagination(string $search, bool $active): LengthAwarePaginator
    {
        return $this->query($search, $active)->paginate(10);
    }

    public function noPagination(string $search, bool $active): Collection
    {
        return $this->query($search, $active)->get();
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
}
