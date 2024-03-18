<?php

namespace App\Data\Repositories\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface IEntityRepository
{
    public function create(Model $model): int;
    public function update(Model $model): bool;
    public function read(Model $model, int $id): Collection;
}
