<?php

namespace App\Repositories\Interfaces;

interface PermissionRepositoryInterface
{
    public function create(int $id, int $permission): bool;
}
