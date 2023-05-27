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
        return true;
    }

    public function getAll(int $id): Collection
    {
        return collect();
    }
}
