<?php

namespace App\Data\Repositories\Order\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IListAllOrderRepository
{
    public function hasPagination(string|int $search, bool $filter): LengthAwarePaginator;
    public function noPagination(string|int $search, bool $filter): Collection;
}
