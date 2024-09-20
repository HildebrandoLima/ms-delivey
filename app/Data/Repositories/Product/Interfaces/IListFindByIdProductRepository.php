<?php

namespace App\Data\Repositories\Product\Interfaces;

use Illuminate\Support\Collection;

interface IListFindByIdProductRepository
{
    public function listFindById(int $id, bool $filter): Collection;
}
