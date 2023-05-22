<?php

namespace App\Services\Product\Interfaces;

use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface IListProductService
{
    public function listProductAll(Pagination $pagination, string $search): Collection;
    public function listProductFind(int $id): Collection;
}
