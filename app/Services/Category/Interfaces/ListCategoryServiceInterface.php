<?php

namespace App\Services\Category\Interfaces;

use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface ListCategoryServiceInterface
{
    public function listCategoryAll(Pagination $pagination, string $search, bool $active): Collection;
    public function listCategoryFind(int $id, bool $active): Collection;
}
