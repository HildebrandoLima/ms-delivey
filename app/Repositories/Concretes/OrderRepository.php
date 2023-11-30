<?php

namespace App\Repositories\Concretes;

use App\Dtos\OrderDto;
use App\Models\Pedido;
use App\Repositories\Abstracts\IOrderRepository;
use App\Support\AutoMapper\DtoMapper;
use App\Support\MapperEntity\EntityOrder;
use App\Support\MapperEntity\EntityPerson;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\DateFormat\DateFormat;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class OrderRepository implements IOrderRepository
{
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
        return PaginationList::createFromPagination($collection);
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
        return collect($collection);
    }

    private function query(): Builder
    {
        return Pedido::query()->with('item')->with('pagamento')->with('endereco');
    }

    private function map(array $data): OrderDto
    {
        return DtoMapper::map($data, OrderDto::class);
    }
}
