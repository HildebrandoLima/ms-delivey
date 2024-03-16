<?php

namespace App\Data\Repositories\Abstracts;

use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface IProviderRepository
{
    public function readAll(Pagination $pagination, string $search, bool $filter): Collection;
    public function readOne(int $id, bool $filter): Collection;
}
