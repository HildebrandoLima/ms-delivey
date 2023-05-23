<?php

namespace App\Services\User;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\UserRepository;
use App\Services\User\Interfaces\IDeleteUserService;

class DeleteUserService implements IDeleteUserService
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

    public function deleteUser(int $id): bool
    {
        $this->checkRegisterRepository->checkUserIdExist($id);
        $this->userRepository->delete($id);
        return true;
    }
}
