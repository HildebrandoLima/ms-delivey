<?php

namespace App\Services\User;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\UserRepository;
use App\Services\User\Interfaces\IListUserService;
use Illuminate\Support\Collection;

class ListUserService implements IListUserService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private UserRepository $userRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        UserRepository          $userRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->userRepository          = $userRepository;
    }

    public function listUserAll(int $active): Collection
    {
        return $this->userRepository->getAll($active);
    }

    public function listUserFind(int $id, string $search, int $active): Collection
    {
        if ($id != 0) $this->checkRegisterRepository->checkUserIdExist($id);
        return $this->userRepository->getFind($id, $search, $active);
    }
}
