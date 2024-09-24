<?php

namespace App\Data\Repositories\Product\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IListAllProductRepository
{
    public function hasPagination(string|int $search, bool $filter): LengthAwarePaginator;
    public function noPagination(string|int $search, bool $filter): Collection;
}
