<?php

namespace App\Services\User;

use App\Repositories\UserRepository;
use App\Services\User\Interfaces\IListUserService;
use App\Support\Utils\CheckRegister\CheckUser;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

class ListUserService implements IListUserService
{
    private CheckUser $checkUser;
    private UserRepository $userRepository;

    public function __construct
    (
        CheckUser      $checkUser,
        UserRepository $userRepository
    )
    {
        $this->checkUser      = $checkUser;
        $this->userRepository = $userRepository;
    }

    public function listUserAll(Pagination $pagination, string $search): Collection
    {
        return $this->userRepository->getAll($pagination, $search);
    }

    public function listUserFind(int $id): Collection
    {
        $this->checkUser->checkUserIdExist($id);
        return $this->userRepository->getFind($id);
    }
}
