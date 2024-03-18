<?php

namespace App\Domains\Services\Order\Abstracts;

use Illuminate\Support\Collection;

interface IListOrderService
{
    public function listOrderAll(string $search, int $id, bool $filter): Collection;
    public function listOrderFind(int $id, bool $filter): Collection;
}
