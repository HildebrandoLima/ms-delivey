<?php

namespace App\Repositories\Interfaces;

use App\DataTransferObjects\Dtos\UserDto;
use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function emailVerifiedAt(int $id, int $active): bool;
    public function create(User $user): int;
    public function update(int $id, User $user): bool;
    public function getAll(int $active): Collection;
    public function getOne(int $id, string $search, int $active): Collection;
}
