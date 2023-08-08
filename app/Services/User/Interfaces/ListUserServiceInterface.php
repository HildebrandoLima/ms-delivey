<?php

namespace App\Services\User\Interfaces;

use Illuminate\Support\Collection;

interface ListUserServiceInterface
{
    public function listUserAll(string $search): Collection;
    public function listUserOne(int $id): Collection;
}
