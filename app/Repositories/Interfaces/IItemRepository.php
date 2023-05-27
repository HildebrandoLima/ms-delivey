<?php

namespace App\Repositories\Interfaces;

use App\Models\Item;
use Illuminate\Support\Collection;

interface IItemRepository {
    public function insert(Item $item): bool;
    public function update(int $id, Item $item): bool;
    public function delete(int $id): bool;
    public function getAll(int $id): Collection;
}
