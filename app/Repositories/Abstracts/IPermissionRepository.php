<?php

namespace App\Repositories\Abstracts;

interface IPermissionRepository
{
    public function create(int $user, int $permission): bool;
}
