<?php

namespace App\Data\Repositories\Category\Concretes;

use App\Data\Repositories\Category\Interfaces\IListFindByIdCategoryRepository;
use App\Models\Categoria;
use App\Support\Queries\QueryFilter;
use Illuminate\Support\Collection;

class ListFindByIdCategoryRepository implements IListFindByIdCategoryRepository
{
    public function listFindById(int $id, bool $active): Collection
    {
        return Categoria::query()
        ->where(function($query) use ($active) {
            QueryFilter::getQueryFilter($query, $active);
        })->where('id', '=', $id)->get();
    }
}
