<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Support\Collection;

interface IUserRepository
{
    public function create(User $user): User;
    public function emailVerifiedAt(int $id, int $active): bool;
    public function update(int $id, User $user): User;
    public function delete(int $id): bool;
    public function enableDisable(int $id, int $active): bool;
    public function getAll(int $active): Collection;
    public function getFind(int $id, string $search, int $active): Collection;
}
