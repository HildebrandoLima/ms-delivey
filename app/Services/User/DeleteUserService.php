<?php

namespace App\Services\User;

use App\Repositories\UserRepository;
use App\Services\User\Interfaces\IDeleteUserService;
use App\Support\Utils\CheckRegister\CheckUser;

class DeleteUserService implements IDeleteUserService
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

    public function deleteUser(int $id): bool
    {
        $this->checkUser->checkUserIdExist($id);
        $this->userRepository->delete($id);
        return true;
    }
}
