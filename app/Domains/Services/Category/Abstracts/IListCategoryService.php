<?php

namespace App\Domains\Services\Category\Abstracts;

use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface IListCategoryService
{
    public function listCategoryAll(Pagination $pagination, string $search, bool $filter): Collection;
    public function listCategoryFind(int $id, bool $filter): Collection;
}
