<?php

namespace App\Data\Repositories\Concretes;

use App\Domains\Dtos\ProviderDto;
use App\Data\Repositories\Abstracts\IProviderRepository;
use App\Domains\Traits\Dtos\AutoMapper;
use App\Models\Fornecedor;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ProviderRepository implements IProviderRepository
{
    use AutoMapper;

    public function hasPagination(string $search, bool $filter): Collection
    {
        $collection = $this->query($search, 0, $filter)->paginate(10);
        foreach ($collection->items() as $key => $instance):
          $collection[$key] = $this->map($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    public function noPagination(string $search, bool $filter): Collection
    {
        $collection = $this->query($search, 0, $filter)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = $this->map($instance);
        endforeach;
        return $collection;
    }

    public function readOne(int $id, bool $filter): Collection
    {
        $collection = $this->query('', $id, $filter)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = $this->map($instance);
        endforeach;
        return $collection;
    }

    private function query(string $search, int $id, bool $filter): Builder
    {
        return Fornecedor::with('endereco')->with('telefone')
        ->where(function($query) use ($search, $id, $filter) {
            QueryFilter::getQueryFilter($query, $filter);
            if (!empty($search)):
                $query->where('fornecedor.razao_social', 'like', $search);
            elseif (!empty($id)):
                $query->where('fornecedor.id', '=', $id);
            else:
                QueryFilter::getQueryFilter($query, $filter);
            endif;
        })->orderByDesc('id');
    }

    private function map(array $data): ProviderDto
    {
        return $this->mapper($data, ProviderDto::class);
    }
}
