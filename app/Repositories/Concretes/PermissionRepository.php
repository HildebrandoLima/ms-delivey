<?php

namespace App\Repositories\Concretes;

use App\Models\PermissionUser;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function create(int $user, int $permission): bool
    {
        return PermissionUser::query()->insert([
            'user_id' => $user,
            'permission_id' => $permission,
        ]);
    }   
}
