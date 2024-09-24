<?php

namespace App\Data\Repositories\Product\Concretes;

use App\Data\Repositories\Product\Interfaces\IListFindByIdProductRepository;
use App\Models\Produto;
use App\Support\Queries\QueryFilter;
use Illuminate\Support\Collection;

class ListFindByIdProductRepository implements IListFindByIdProductRepository
{
    public function listFindById(int $id, bool $active): Collection
    {
        return Produto::query()->with('imagem')
        ->where(function($query) use ($id, $active) {
            QueryFilter::getQueryFilter($query, $active);
        })->where('produto.id', '=', $id)->get();
    }
}
