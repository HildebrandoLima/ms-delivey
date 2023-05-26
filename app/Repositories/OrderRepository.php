<?php

namespace App\Repositories;

use App\Models\Pedido;
use App\Repositories\Interfaces\IOrderRepository;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class OrderRepository implements IOrderRepository {
    public function insert(Pedido $pedido): int
    {
        return Pedido::query()->insertGetId($pedido->toArray());
    }

    public function update(int $id, Pedido $pedido): bool
    {
        return true;
    }

    public function delete(int $id): bool
    {
        return Pedido::query()->where('id', $id)->delete();
    }

    public function getAll(Pagination $pagination, string $search): Collection
    {
        $query = $this->mapToQuery();
        $query->orderByDesc('id');
        if (isset ($pagination->page) && isset ($pagination->perPage)):
            return PaginationList::createFromPagination($query, $pagination);
        endif;
        return $query->where('numero_pedido', 'like', $search)->get();
    }

    public function getFind(int $id): Collection
    {
        return $this->mapToQuery()->where('id', $id)->get();
    }

    private function mapToQuery(): Builder
    {
        return Pedido::query()->select([
            'id as pedidoId',
            'numero_pedido as numeroPedido',
            'quantidade_item as quantidadeItem',
            'total as total',
            'entrega as entrega',
            'ativo as ativo',
            'usuario_id as usuarioId',
            'created_at as criadoEm',
            'updated_at as alteradoEm'
        ]);
    }
}
