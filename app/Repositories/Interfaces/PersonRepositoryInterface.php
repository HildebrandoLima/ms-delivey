<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface PersonRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function emailVerifiedAt(int $id, int $active): bool;
    public function create(array $dto): Model;
    public function update(int $id, array $dto): bool;
    public function getAll(int $active): Collection;
    public function getOne(int $id, string $search, int $active): Collection;
}
