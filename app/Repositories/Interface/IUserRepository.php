<?php

namespace App\Repositories\Interface;

use App\Models\User;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface IUserRepository {
    public function insert(User $user): int;
    public function update(int $id, User $user): bool;
    public function delete(int $id): bool;
    public function getAll(Pagination $pagination, string $search): Collection;
    public function getFind(int $id): Collection;
}
