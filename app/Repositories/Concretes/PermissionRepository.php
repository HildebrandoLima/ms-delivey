<?php

namespace App\Repositories\Concretes;

use App\Models\PermissionUser;
use App\Repositories\Abstracts\IPermissionRepository;

class PermissionRepository implements IPermissionRepository
{
    public function create(int $user, int $permission): bool
    {
        return PermissionUser::query()->insert([
            'user_id' => $user,
            'permission_id' => $permission,
        ]);
    }   
}
