<?php

namespace App\Services\Category\Interfaces;

use Illuminate\Support\Collection;

interface IListCategoryService
{
    public function listCategoryAll(string $search): Collection;
    public function listProviderFind(int $id): Collection;
}
