<?php

namespace App\Repositories\Concretes;

use App\Models\Item;
use App\Repositories\Interfaces\ItemRepositoryInterface;

class ItemRepository implements ItemRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool
    {
        return Item::query()->where('pedido_id', $id)->update(['ativo' => $active]);
    }

    public function create(Item $item): bool
    {
        Item::query()->create($item->toArray());
        return true;
    }
}
