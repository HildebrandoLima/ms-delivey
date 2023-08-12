<?php

namespace App\Services\User\Abstracts;

use Illuminate\Support\Collection;

interface IListUserService
{
    public function listUserAll(string $search, bool $filter): Collection;
    public function listUserOne(int $id, bool $filter): Collection;
}
