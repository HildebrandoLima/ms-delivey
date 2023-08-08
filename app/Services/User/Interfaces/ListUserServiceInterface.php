<?php

namespace App\Services\User\Interfaces;

use Illuminate\Support\Collection;

interface ListUserServiceInterface
{
    public function listUserAll(string $search, bool $filter): Collection;
    public function listUserOne(int $id, bool $filter): Collection;
}
