<?php

namespace App\Repositories\Concretes;

use App\DataTransferObjects\MappersDtos\OrderMapperDto;
use App\Models\Pedido;
use App\Repositories\Abstracts\IOrderRepository;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class OrderRepository implements IOrderRepository
{
    public function readAll(string $search, int $id, bool $filter): Collection
    {
        $collection = $this->query()->where('pedido.ativo', '=', $filter)
        ->orderByDesc('pedido.id')
        ->whereHas('usuario', function ($query) use ($id, $search) {
            if (!empty($id)):
                $query->where('users.id', '=', $id)
                ->where(function($query) use ($search) {
                    if (!empty($search)):
                        $query->where('pedido.numero_pedido', 'like', $search);
                    endif;
                });
            else:
                $query->where('users.is_admin', '=', true)
                ->where(function($query) use ($search) {
                    if (!empty($search)):
                        $query->where('pedido.numero_pedido', 'like', $search);
                    endif;
                });
            endif;
        })->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = OrderMapperDto::mapper($instance->toArray());
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
            $collection[$key] = OrderMapperDto::mapper($instance);
        endforeach;
        return collect($collection);
    }

    private function query(): Builder
    {
        return Pedido::query()->with('item')->with('pagamento')->with('usuario');
    }
}
