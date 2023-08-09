<?php

namespace App\Services\Product\Interfaces;

use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface ListProductServiceInterface
{
    public function listProductAll(Pagination $pagination, string $search, bool $filter): Collection;
    public function listProductFind(int $id, bool $filter): Collection;
}
