<?php

namespace App\Services\User\Concretes;

use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\ListUserServiceInterface;
use Illuminate\Support\Collection;

class ListUserService implements ListUserServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;
    private UserRepositoryInterface        $userRepositoryInterface;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepositoryInterface,
        UserRepositoryInterface        $userRepositoryInterface,
    )
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
        $this->userRepositoryInterface        = $userRepositoryInterface;
    }

    public function listUserAll(int $active): Collection
    {
        return $this->userRepositoryInterface->getAll($active);
    }

    public function listUserFind(int $id, string $search, int $active): Collection
    {
        if ($id != 0) $this->checkEntityRepositoryInterface->checkUserIdExist($id);
        return $this->userRepositoryInterface->getOne($id, $search, $active);
    }
}
