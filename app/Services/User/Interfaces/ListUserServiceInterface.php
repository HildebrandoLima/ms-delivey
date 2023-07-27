<?php

namespace App\Services\User\Interfaces;

use Illuminate\Support\Collection;

interface ListUserServiceInterface
{
    public function listUserAll(string $search, bool $active): Collection;
    public function listUserFind(int $id, bool $active): Collection;
}
