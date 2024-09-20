<?php

namespace App\Data\Repositories\Provider\Concretes;

use App\Data\Repositories\Provider\Interfaces\IListFindByIdProviderRepository;
use App\Domains\Dtos\ProviderDto;
use App\Domains\Traits\Dtos\AutoMapper;
use App\Models\Fornecedor;
use App\Support\Queries\QueryFilter;
use Illuminate\Support\Collection;

class ListFindByIdProviderRepository implements IListFindByIdProviderRepository
{
    use AutoMapper;

    public function listFindById(int $id, bool $active): Collection
    {
        $collection = $this->query($id, $active);
        foreach ($collection->toArray() as $key => $value) {
            $collection[$key] = $this->mapTo($value, ProviderDto::class);
        }
        return $collection;
    }

    private function query(int $id, bool $active): Collection
    {
        return Fornecedor::with('endereco')->with('telefone')
        ->where(function($query) use ($active) {
            QueryFilter::getQueryFilter($query, $active);
        })->where('users.id', $id)->get();
    }
}
