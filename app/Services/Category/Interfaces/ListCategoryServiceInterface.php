<?php

namespace App\Services\Category\Interfaces;

use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface ListCategoryServiceInterface
{
    public function listCategoryAll(Pagination $pagination, int $active): Collection;
    public function listCategoryFind(int $id, string $search, int $active): Collection;
}
