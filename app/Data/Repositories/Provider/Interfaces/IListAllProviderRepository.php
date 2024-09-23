<?php

namespace App\Data\Repositories\Provider\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IListAllProviderRepository
{
    public function hasPagination(string $search, bool $filter): LengthAwarePaginator;
    public function noPagination(string $search, bool $filter): Collection;
}

