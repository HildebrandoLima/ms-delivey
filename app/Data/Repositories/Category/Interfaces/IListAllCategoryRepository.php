<?php

namespace App\Data\Repositories\Category\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IListAllCategoryRepository
{
    public function hasPagination(string $search, bool $filter): LengthAwarePaginator;
    public function noPagination(string $search, bool $filter): Collection;
}
