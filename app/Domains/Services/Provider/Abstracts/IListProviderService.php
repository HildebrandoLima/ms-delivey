<?php

namespace App\Domains\Services\Provider\Abstracts;

use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface IListProviderService
{
    public function listProviderAll(Pagination $pagination, string $search, bool $filter): Collection;
    public function listProviderFind(int $id, bool $filter): Collection;
}
