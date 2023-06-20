<?php

namespace App\Repositories;

use App\DataTransferObjects\Dtos\UserDto;
use App\Models\User;
use Illuminate\Support\Collection;

interface EntityRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function emailVerifiedAt(int $id, int $active): bool;
    public function create(UserDto $dto): User;
    public function update(int $id, UserDto $dto): bool;
    public function delete(int $id): bool;
    public function getAll(int $active): Collection;
    public function getOne(int $id, string $search, int $active): Collection;
}
