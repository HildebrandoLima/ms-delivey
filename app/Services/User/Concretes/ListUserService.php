<?php

namespace App\Services\User\Concretes;

use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\ListUserServiceInterface;
use Illuminate\Support\Collection;

class ListUserService implements ListUserServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private UserRepositoryInterface        $userRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        UserRepositoryInterface        $userRepository,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->userRepository        = $userRepository;
    }

    public function listUserAll(int $active): Collection
    {
        return $this->userRepository->getAll($active);
    }

    public function listUserFind(int $id, string $search, int $active): Collection
    {
        if ($id != 0) $this->checkEntityRepository->checkUserIdExist($id);
        return $this->userRepository->getOne($id, $search, $active);
    }
}
