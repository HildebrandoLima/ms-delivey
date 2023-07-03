<?php

namespace App\Support\Permissions;

use App\Repositories\Interfaces\AuthRepositoryInterface;

class CreatePermissions
{
    private AuthRepositoryInterface $authRepository;
    private array $permissionsAdmin = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29];
    private array $permissionsClient = [2, 3, 4, 5, 10, 11, 12, 13, 22, 23, 24, 25, 26, 27, 28, 29];

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function createPermissions(int $perfil, int $userId): bool
    {
        if ($perfil == 1):
            foreach ($this->permissionsAdmin as $permission):
                $this->authRepository->create($userId, $permission);
            endforeach;
        endif;
            foreach ($this->permissionsClient as $permission):
                $this->authRepository->create($userId, $permission);
            endforeach;
        return true;
    }
}
