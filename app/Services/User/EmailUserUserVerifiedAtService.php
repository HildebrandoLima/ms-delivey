<?php

namespace App\Services\User;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\UserRepository;
use App\Services\User\Interfaces\IEmailUserVerifiedAtService;

class EmailUserUserVerifiedAtService implements IEmailUserVerifiedAtService
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

    public function emailVerifiedAt(int $id, int $active): bool
    {
        $this->checkRegisterRepository->checkUserIdExist($id);
        return $this->userRepository->emailVerifiedAt($id, $active);
    }
}
