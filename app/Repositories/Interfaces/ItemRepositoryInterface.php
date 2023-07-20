<?php

namespace App\Repositories\Interfaces;

use App\Models\Item;

interface ItemRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function create(Item $item): bool;
}
