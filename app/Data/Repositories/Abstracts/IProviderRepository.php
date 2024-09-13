<?php

namespace App\Data\Repositories\Abstracts;

use Illuminate\Support\Collection;

interface IProviderRepository
{
    public function hasPagination(string $search, bool $filter): Collection;
    public function noPagination(string $search, bool $filter): Collection;
    public function readOne(int $id, bool $filter): Collection;
}
