<?php

namespace App\Services\Category\Interfaces;

use Illuminate\Support\Collection;

interface ListCategoryServiceInterface
{
    public function listCategoryAll(int $active): Collection;
    public function listProviderFind(int $id, string $search, int $active): Collection;
}
