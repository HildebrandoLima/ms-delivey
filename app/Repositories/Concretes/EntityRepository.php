<?php

namespace App\Repositories\Concretes;

use App\Repositories\Abstracts\IEntityRepository;
use Illuminate\Database\Eloquent\Model;

class EntityRepository implements IEntityRepository
{
    public function create(Model $model): int
    {
        return $model::query()->create($model->toArray())->orderBy('id', 'desc')->first()->id;
    }

    public function update(Model $model): bool
    {
        return $model::query()->where('id', '=', $model->id)->update($model->toArray());
    }
}
