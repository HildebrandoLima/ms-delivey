<?php

namespace App\Data\Repositories\Order\Concretes;

use App\Data\Repositories\Order\Interfaces\IListFindByIdOrderRepository;
use App\Domains\Dtos\OrderDto;
use App\Domains\Traits\Dtos\AutoMapper;
use App\Models\Pedido;
use App\Support\Queries\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ListFindByIdOrderRepository implements IListFindByIdOrderRepository
{
    use AutoMapper;

    public function listFindById(int $id, bool $active): Collection
    {
        $collection = $this->query()
        ->where(function($query) use ($active) {
            QueryFilter::getQueryFilter($query, $active);
        })->where('pedido.id', '=', $id)->get();

        foreach ($collection->toArray() as $key => $value) {
            $collection[$key] = $this->map($value);
        }
        return $collection;
    }

    private function query(): Builder
    {
        return Pedido::query()->with('item')->with('pagamento')->with('endereco');
    }

    private function map(array $data): OrderDto
    {
        return $this->mapper($data, OrderDto::class);
    }
}
