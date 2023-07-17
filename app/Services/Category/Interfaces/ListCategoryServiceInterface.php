<?php

namespace App\Services\Category\Interfaces;

use Illuminate\Support\Collection;

interface ListCategoryServiceInterface
{
    public function listCategoryAll(int $active): Collection;
    public function listCategoryFind(int $id, string $search, int $active): Collection;
}
