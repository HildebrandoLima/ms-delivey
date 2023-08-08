<?php

namespace App\Repositories\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface EntityRepository
{
    public function create(Model $model): int;
    public function update(Model $model): bool;
    public function readAll(string $search, bool $filter): Collection;
    public function readOne(int $id, bool $filter): Collection;
}
