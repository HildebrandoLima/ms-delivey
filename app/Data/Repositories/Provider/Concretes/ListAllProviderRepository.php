<?php

namespace App\Data\Repositories\Provider\Concretes;

use App\Data\Repositories\Provider\Interfaces\IListAllProviderRepository;
use App\Domains\Dtos\ProviderDto;
use App\Domains\Traits\Dtos\AutoMapper;
use App\Models\Fornecedor;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\Pagination\PaginatedList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ListAllProviderRepository implements IListAllProviderRepository
{
    use AutoMapper;

    public function hasPagination(string $search, bool $active): Collection
    {
        $collection = $this->query($search, $active)->paginate(10);
        foreach ($collection->items() as $key => $value) {
          $collection[$key] = $this->mapTo($value->toArray(), ProviderDto::class);
        }
        return PaginatedList::createFromPagination($collection);
    }

    public function noPagination(string $search, bool $active): Collection
    {
        $collection = $this->query($search, $active)->get();
        foreach ($collection->toArray() as $key => $value) {
            $collection[$key] = $this->mapTo($value, ProviderDto::class);
        }
        return $collection;
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
