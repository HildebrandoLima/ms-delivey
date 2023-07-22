<?php

namespace App\Services\Product\Interfaces;

use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface ListProductServiceInterface
{
    public function listProductAll(Pagination $pagination, int $active): Collection;
    public function listProductFind(int $id, string $search, int $active): Collection;
}
