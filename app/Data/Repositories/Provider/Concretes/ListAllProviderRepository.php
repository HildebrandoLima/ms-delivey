<?php

namespace App\Data\Repositories\Provider\Concretes;

use App\Data\Repositories\Provider\Interfaces\IListAllProviderRepository;
use App\Models\Fornecedor;
use App\Support\Queries\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ListAllProviderRepository implements IListAllProviderRepository
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
        return Fornecedor::with('endereco')->with('telefone')
        ->where(function($query) use ($search, $active) {

            QueryFilter::getQueryFilter($query, $active);

            if (!empty($search)) {
                $query->where('fornecedor.razao_social', 'like', $search);
            }
        })->orderByDesc('id');
    }
}
