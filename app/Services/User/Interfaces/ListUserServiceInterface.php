<?php

namespace App\Services\User\Interfaces;

use Illuminate\Support\Collection;

interface ListUserServiceInterface
{
    public function listUserAll(int $active): Collection;
    public function listUserFind(int $id, string $search, int $active): Collection;
}
