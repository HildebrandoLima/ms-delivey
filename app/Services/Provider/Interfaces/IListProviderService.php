<?php

namespace App\Services\Provider\Interfaces;

use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface IListProviderService
{
    public function listProviderAll(Pagination $pagination, string $search): Collection;
    public function listProviderFind(int $id): Collection;
}
