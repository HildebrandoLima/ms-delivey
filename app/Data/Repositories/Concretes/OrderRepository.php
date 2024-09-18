<?php

namespace App\Data\Repositories\Concretes;

use App\Domains\Dtos\OrderDto;
use App\Data\Repositories\Abstracts\IOrderRepository;
use App\Domains\Traits\Dtos\AutoMapper;
use App\Models\Pedido;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\Pagination\PaginatedList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class OrderRepository implements IOrderRepository
{
    use AutoMapper;

    public function readAll(string $search, int $id, bool $filter): Collection
    {
        $collection = $this->query()
        ->where(function ($query) use ($id, $search, $filter) {
            QueryFilter::getQueryFilter($query, $filter)
            ->where(function($query) use ($id, $search) {
                if (!empty($search)):
                    $query->where('pedido.numero_pedido', 'like', $search);
                else:
                    $query->where('pedido.usuario_id', '=', $id);
                endif;
            });
        })->orderByDesc('pedido.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = $this->map($instance->toArray());
        endforeach;
        return PaginatedList::createFromPagination($collection);
    }

    public function readOne(int $id, bool $filter): Collection
    {
        $collection = $this->query()
        ->where(function($query) use ($filter) {
            QueryFilter::getQueryFilter($query, $filter);
        })->where('pedido.id', '=', $id)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = $this->map($instance);
        endforeach;
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
