<?php

namespace App\Repositories\Abstracts;

use Illuminate\Database\Eloquent\Model;

interface IPermissionRepository
{
    public function create(Model $model): bool;
}
