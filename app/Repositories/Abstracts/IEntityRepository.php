<?php

namespace App\Repositories\Abstracts;

use Illuminate\Database\Eloquent\Model;

interface IEntityRepository
{
    public function create(Model $model): int;
    public function update(Model $model): bool;
}
