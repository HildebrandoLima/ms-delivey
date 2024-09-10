<?php

namespace App\Data\Repositories\Abstracts;

use Illuminate\Support\Collection;

interface IProductRepository
{
    public function hasPagination(string|int $search, bool $filter): Collection;
    public function noPagination(string|int $search, bool $filter): Collection;
    public function readOne(int $id, bool $filter): Collection;
    public function delete(int $id): bool;
}
