<?php

namespace App\Data\Repositories\Abstracts;

use Illuminate\Database\Eloquent\Model;

interface IPermissionRepository
{
    public function create(Model $model): bool;
}
