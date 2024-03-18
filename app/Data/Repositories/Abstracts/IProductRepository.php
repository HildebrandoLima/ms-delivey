<?php

namespace App\Data\Repositories\Abstracts;

use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface IProductRepository
{
    public function readAll(Pagination $pagination, string|int $search, bool $active): Collection;
    public function readOne(int $id, bool $active): Collection;
    public function delete(int $id): bool;
}
