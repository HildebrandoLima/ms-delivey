<?php

namespace App\Repositories\Interfaces;

use App\Models\Item;
use Illuminate\Support\Collection;

interface IItemRepository {
    public function create(Item $item): bool;
    public function update(int $id, Item $item): bool;
    public function delete(int $id): bool;
    public function getAll(int $id, int $active): Collection;
}
