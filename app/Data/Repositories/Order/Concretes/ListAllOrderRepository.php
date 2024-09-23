<?php

namespace App\Data\Repositories\Order\Concretes;

use App\Data\Repositories\Order\Interfaces\IListAllOrderRepository;
use App\Models\Pedido;
use App\Support\Queries\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ListAllOrderRepository implements IListAllOrderRepository
{
    public function hasPagination(string|int $search, bool $active): LengthAwarePaginator
    {
        return $this->query($search, $active)->paginate(10);
    }

    public function noPagination(string|int $search, bool $active): Collection
    {
        return $this->query($search, $active)->get();
    }

    private function query(string|int $search, bool $active): Builder
    {
        return Pedido::query()->with('item')->with('pagamento')->with('endereco')
        ->where(function ($query) use ($search, $active) {
            QueryFilter::getQueryFilter($query, $active)
            ->where(function($query) use ($search) {
                $query->where('pedido.usuario_id', '=', $search)
                ->orWhere('pedido.numero_pedido', 'like', $search);
            });
        })->orderByDesc('pedido.id');
    }
}
