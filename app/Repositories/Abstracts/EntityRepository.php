<?php

namespace App\Repositories\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface EntityRepository
{
    public function create(Model $model): int;
    public function update(Model $model): bool;
    public function readAll(string $search): Collection;
    public function readOne(int $id): Collection;
}
