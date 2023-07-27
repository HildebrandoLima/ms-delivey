<?php

namespace App\Services\User\Concretes;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\ListUserServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Enums\PermissionEnum;
use Illuminate\Support\Collection;

class ListUserService extends ValidationPermission implements ListUserServiceInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function listUserAll(string $search, bool $active): Collection
    {
        $this->validationPermission(PermissionEnum::LISTAR_USUARIOS);
        return $this->userRepository->getAll($search, $active);
    }

    public function listUserFind(int $id, bool $active): Collection
    {
        $this->validationPermission(PermissionEnum::LISTAR_DETALHES_USUARIO);
        return $this->userRepository->getOne($id, $active);
    }
}
