<?php

namespace App\Services\Permission\Interfaces;

interface CreatePermissionServiceInterface
{
    public function createPermission(bool $isAdmin, int $userId): bool;
}
