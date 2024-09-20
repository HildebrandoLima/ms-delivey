<?php

namespace App\Data\Repositories\Order\Interfaces;

use Illuminate\Support\Collection;

interface IListAllOrderRepository
{
    public function listAll(string $search, int $id, bool $filter): Collection;
}
