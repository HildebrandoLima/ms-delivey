<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Parameters\FilterByActive;
use Illuminate\Support\Collection;

interface IUserRepository {
    public function insert(User $user): int;
    public function update(int $id, User $user): bool;
    public function delete(int $id): bool;
    public function getAll(Pagination $pagination, int $active): Collection;
    public function getFind(int $id, string $search, int $active): Collection;
}
