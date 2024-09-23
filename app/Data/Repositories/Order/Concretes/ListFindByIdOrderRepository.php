<?php

namespace App\Data\Repositories\Order\Concretes;

use App\Data\Repositories\Order\Interfaces\IListFindByIdOrderRepository;
use App\Models\Pedido;
use App\Support\Queries\QueryFilter;
use Illuminate\Support\Collection;

class ListFindByIdOrderRepository implements IListFindByIdOrderRepository
{
    public function listFindById(int $id, bool $active): Collection
    {
        return Pedido::query()->with('item')->with('pagamento')->with('endereco')
        ->where(function($query) use ($active) {
            QueryFilter::getQueryFilter($query, $active);
        })->where('pedido.id', '=', $id)->get();
    }
}
