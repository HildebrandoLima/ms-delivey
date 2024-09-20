<?php

namespace App\Data\Repositories\User\Interfaces;

use Illuminate\Support\Collection;

interface IListAllUserRepository
{
    public function hasPagination(string $search, bool $filter): Collection;
    public function noPagination(string $search, bool $filter): Collection;
}
