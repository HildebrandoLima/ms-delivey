<?php

namespace App\Services\Permission\Concretes;

use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Services\Permission\Interfaces\CreatePermissionServiceInterface;

class CreatePermissionService implements CreatePermissionServiceInterface
{
    private PermissionRepositoryInterface $permissionRepository;
    private array $permissionsAdmin = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
    private array $permissionsClient = [3, 7, 10, 11, 16, 19];

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function createPermission(bool $isAdmin, int $userId): bool
    {
        if ($isAdmin == true):
            foreach ($this->permissionsAdmin as $permission):
                $this->permissionRepository->create($userId, $permission);
            endforeach;
        endif;
            foreach ($this->permissionsClient as $permission):
                $this->permissionRepository->create($userId, $permission);
            endforeach;
        return true;
    }
}
