<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function emailVerifiedAt(int $id, bool $active): bool;
    public function create(User $user): int;
    public function update(User $user): bool;
    public function getAll(string $search, bool $active): Collection;
    public function getOne(int $id, bool $active): Collection;
}
