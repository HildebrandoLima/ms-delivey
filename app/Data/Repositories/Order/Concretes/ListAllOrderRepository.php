<?php

namespace App\Data\Repositories\Order\Concretes;

use App\Data\Repositories\Order\Interfaces\IListAllOrderRepository;
use App\Domains\Dtos\OrderDto;
use App\Domains\Traits\Dtos\AutoMapper;
use App\Models\Pedido;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\Pagination\PaginatedList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ListAllOrderRepository implements IListAllOrderRepository
{
    use AutoMapper;

    public function listAll(string $search, int $id, bool $active): Collection
    {
        $collection = $this->query()
        ->where(function ($query) use ($id, $search, $active) {

            QueryFilter::getQueryFilter($query, $active)

            ->where(function($query) use ($id, $search) {

                if (!empty($search)) {
                    $query->where('pedido.numero_pedido', 'like', $search);
                } else {
                    $query->where('pedido.usuario_id', '=', $id);
                }
            });
        })->orderByDesc('pedido.id')->paginate(10);

        foreach ($collection->items() as $key => $value) {
            $collection[$key] = $this->mapTo($value->toArray(), OrderDto::class);
        }
        return PaginatedList::createFromPagination($collection);
    }

    private function query(): Builder
    {
        return Pedido::query()->with('item')->with('pagamento')->with('endereco');
    }
}
