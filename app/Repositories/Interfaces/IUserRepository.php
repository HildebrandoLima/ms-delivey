<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Support\Collection;

interface IUserRepository {
    public function create(User $user): int;
    public function update(int $id, User $user): bool;
    public function delete(int $id): bool;
    public function getAll(int $active): Collection;
    public function getFind(int $id, string $search, int $active): Collection;
}
