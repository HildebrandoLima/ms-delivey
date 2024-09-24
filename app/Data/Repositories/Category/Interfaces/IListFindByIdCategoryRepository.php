<?php

namespace App\Data\Repositories\Category\Interfaces;

use Illuminate\Support\Collection;

interface IListFindByIdCategoryRepository
{
    public function listFindById(int $id, bool $filter): Collection;
}
