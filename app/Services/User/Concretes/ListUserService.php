<?php

namespace App\Services\User\Concretes;

use App\Repositories\Abstracts\EntityRepository;
use App\Services\User\Interfaces\ListUserServiceInterface;
use Illuminate\Support\Collection;

class ListUserService implements ListUserServiceInterface
{
    private EntityRepository $userRepository;

    public function __construct(EntityRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function listUserAll(string $search): Collection
    {
        return $this->userRepository->readAll($search);
    }

    public function listUserOne(int $id): Collection
    {
        return $this->userRepository->readOne($id);
    }
}
