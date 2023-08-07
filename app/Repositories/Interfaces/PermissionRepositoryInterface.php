<?php

namespace App\Repositories\Interfaces;

interface PermissionRepositoryInterface
{
    public function create(int $user, int $permission): bool;
}
