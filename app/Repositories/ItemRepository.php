<?php

namespace App\Repositories;

use App\Models\Item;
use App\Repositories\Interfaces\IItemRepository;
use Illuminate\Support\Collection;

class ItemRepository implements IItemRepository {
    public function insert(Item $item): bool
    {
        return Item::query()->insert($item->toArray());
    }

    public function update(int $id, Item $item): bool
    {
        return true;
    }

    public function delete(int $id): bool
    {
        return Item::query()->where('pedido_id', $id)->delete();
    }

    public function getAll(int $id): Collection
    {
        return Item::query()
        ->join('pedido as p', 'p.id', '=', 'item.pedido_id')
        ->select([
            'item.nome as item',
            'item.preco as precoUnidade',
            'item.codigo_barra as codigoBarra',
            'item.quantidade_item as quantidadeItem',
            'item.sub_total as subTotal',
            'item.unidade_medida as unidadeMedida',
            'item.ativo as ativo',
            'item.pedido_id as pedidoId',
            'item.produto_id as produtoId',
            'item.created_at as criadoEm',
            'item.updated_at as alteradoEm',
        ])
        ->where('p.id', $id)->get();
    }
}
