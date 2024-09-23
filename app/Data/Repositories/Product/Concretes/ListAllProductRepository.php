<?php

namespace App\Data\Repositories\Product\Concretes;

use App\Data\Repositories\Product\Interfaces\IListAllProductRepository;
use App\Models\Produto;
use App\Support\Queries\QueryFilter;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ListAllProductRepository implements IListAllProductRepository
{
    public function hasPagination(string|int $search, bool $active): LengthAwarePaginator
    {
        return $this->query($search, $active)->paginate(10);
    }

    public function noPagination(string|int $search, bool $active): Collection
    {
        return $this->query($search, $active)->get();
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
