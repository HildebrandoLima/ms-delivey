<?php

namespace App\Services\User\Interfaces;

use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface IListUserService
{
    public function listUserAll(Pagination $pagination, int $active): Collection;
    public function listUserFind(int $id, string $search, int $active): Collection;
}
