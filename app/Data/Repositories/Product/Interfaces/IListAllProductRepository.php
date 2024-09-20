<?php

namespace App\Data\Repositories\Product\Interfaces;

use Illuminate\Support\Collection;

interface IListAllProductRepository
{
    public function hasPagination(string|int $search, bool $filter): Collection;
    public function noPagination(string|int $search, bool $filter): Collection;
}
