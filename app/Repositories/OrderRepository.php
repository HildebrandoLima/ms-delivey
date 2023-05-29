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

    public function getAll(Pagination $pagination, int $active): Collection
    {
        $query = $this->mapToQuery();
        $query->orderByDesc('pedido.id');
        return PaginationList::createFromPagination($query, $pagination);
    }

    public function getFind(int $id, string $search, int $active): Collection
    {
        return $this->mapToQuery()
        ->where('pedido.ativo', $active)->where('pedido.id', $id)
        ->orWhere('pedido.numero_pedido', 'like', $search)->get();
    }

    private function mapToQuery(): Builder
    {
        return Pedido::query()
        ->leftJoin('pagamento as p', 'p.pedido_id', '=', 'pedido.id')
        ->leftJoin('metodo_pagamento as mp', 'mp.id', '=', 'p.metodo_pagamento_id')
        ->select([
            'pedido.id as pedidoId',
            'pedido.numero_pedido as numeroPedido',
            'pedido.quantidade_item as quantidadeItem',
            'pedido.total as total',
            'pedido.entrega as entrega',
            'pedido.ativo as ativo',
            'pedido.usuario_id as usuarioId',
            'pedido.created_at as criadoEm',
            'pedido.updated_at as alteradoEm',
            'p.codigo_transacao as codigoTransacao',
            'p.numero_cartao as numeroCartao',
            'p.data_validade as dataValidade',
            'p.parcela as parcela'
        ]);
    }
}
