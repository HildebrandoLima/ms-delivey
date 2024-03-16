<?php

namespace App\Data\Repositories\Abstracts;

use Illuminate\Support\Collection;

interface IOrderRepository
{
    public function readAll(string $search, int $id, bool $filter): Collection;
    public function readOne(int $id, bool $filter): Collection;
}
