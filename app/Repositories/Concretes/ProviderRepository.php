<?php

namespace App\Repositories\Concretes;

use App\Dtos\ProviderDto;
use App\Models\Fornecedor;
use App\Repositories\Abstracts\IProviderRepository;
use App\Support\AutoMapper\AutoMapper;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Support\Collection;

class ProviderRepository implements IProviderRepository
{
    public function readAll(string $search, bool $filter): Collection
    {
        $collection = Fornecedor::with('endereco')->with('telefone')
        ->where(function($query) use ($search, $filter) {
            QueryFilter::getQueryFilter($query, $filter);
            if (!empty($search)):
                $query->where('fornecedor.razao_social', 'like', $search);
            else:
                QueryFilter::getQueryFilter($query, $filter);
            endif;
        })->orderByDesc('fornecedor.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = $this->map($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    public function readOne(int $id, bool $filter): Collection
    {
        $collection = Fornecedor::with('endereco')->with('telefone')
        ->where(function($query) use ($filter) {
            QueryFilter::getQueryFilter($query, $filter);
        })->where('fornecedor.id', '=', $id)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = $this->map($instance);
        endforeach;
        return collect($collection);
    }

    private function map(array $data): ProviderDto
    {
        return AutoMapper::map($data, ProviderDto::class);
    }
}
