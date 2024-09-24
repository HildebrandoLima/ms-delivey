<?php

namespace App\Data\Repositories\Order\Interfaces;

use Illuminate\Support\Collection;

interface IListFindByIdOrderRepository
{
    public function listFindById(int $id, bool $filter): Collection;
}
