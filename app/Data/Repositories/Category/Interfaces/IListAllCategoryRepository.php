<?php

namespace App\Data\Repositories\Category\Interfaces;

use Illuminate\Support\Collection;

interface IListAllCategoryRepository
{
    public function hasPagination(string $search, bool $filter): Collection;
    public function noPagination(string $search, bool $filter): Collection;
}
