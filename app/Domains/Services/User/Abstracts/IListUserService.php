<?php

namespace App\Domains\Services\User\Abstracts;

use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface IListUserService
{
    public function listUserAll(Pagination $pagination, string $search, bool $filter): Collection;
    public function listUserFind(int $id, bool $filter): Collection;
}
