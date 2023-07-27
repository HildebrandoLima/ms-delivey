<?php

namespace App\Services\User\Concretes;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\ListUserServiceInterface;
use Illuminate\Support\Collection;

class ListUserService implements ListUserServiceInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function listUserAll(string $search, bool $active): Collection
    {
        return $this->userRepository->getAll($search, $active);
    }

    public function listUserFind(int $id, bool $active): Collection
    {
        return $this->userRepository->getOne($id, $active);
    }
}
