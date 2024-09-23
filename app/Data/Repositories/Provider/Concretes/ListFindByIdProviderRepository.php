<?php

namespace App\Data\Repositories\Provider\Concretes;

use App\Data\Repositories\Provider\Interfaces\IListFindByIdProviderRepository;
use App\Models\Fornecedor;
use App\Support\Queries\QueryFilter;
use Illuminate\Support\Collection;

class ListFindByIdProviderRepository implements IListFindByIdProviderRepository
{
    public function listFindById(int $id, bool $active): Collection
    {
        return Fornecedor::with('endereco')->with('telefone')
        ->where(function($query) use ($active) {
            QueryFilter::getQueryFilter($query, $active);
        })->where('fornecedor.id', $id)->get();
    }
}
