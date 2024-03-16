<?php

namespace App\Data\Repositories\Concretes;

use App\Data\Repositories\Abstracts\IPermissionRepository;
use Illuminate\Database\Eloquent\Model;

class PermissionRepository implements IPermissionRepository
{
    public function create(Model $model): bool
    {
        return $model::query()->insert($model->toArray());
    }   
}
