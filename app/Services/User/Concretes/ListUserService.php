<?php

namespace App\Services\User\Concretes;

use App\Repositories\Abstracts\IUserRepository;
use App\Services\User\Abstracts\IListUserService;
use Illuminate\Support\Collection;

class ListUserService implements IListUserService
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function listUserAll(string $search, bool $filter): Collection
    {
        return $this->userRepository->readAll($search, $filter);
    }

    public function listUserOne(int $id, bool $filter): Collection
    {
        return $this->userRepository->readOne($id, $filter);
    }
}
