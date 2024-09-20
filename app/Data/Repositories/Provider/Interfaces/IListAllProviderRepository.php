<?php

namespace App\Data\Repositories\Provider\Interfaces;

use Illuminate\Support\Collection;

interface IListAllProviderRepository
{
    public function hasPagination(string $search, bool $filter): Collection;
    public function noPagination(string $search, bool $filter): Collection;
}

