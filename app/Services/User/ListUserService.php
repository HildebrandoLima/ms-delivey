<?php

namespace App\Services\User;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\UserRepository;
use App\Services\User\Interfaces\IListUserService;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

class ListUserService implements IListUserService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private UserRepository          $userRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        UserRepository          $userRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->userRepository          = $userRepository;
    }

    public function listUserAll(Pagination $pagination, string $search): Collection
    {
        return $this->userRepository->getAll($pagination, $search);
    }

    public function listUserFind(int $id): Collection
    {
        $this->checkRegisterRepository->checkUserIdExist($id);
        return $this->userRepository->getFind($id);
    }
}
