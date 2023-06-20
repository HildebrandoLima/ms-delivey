<?php

namespace App\Services\User;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\IEmailUserVerifiedAtService;

class EmailUserVerifiedAtService implements IEmailUserVerifiedAtService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        UserRepositoryInterface $userRepositoryInterface,
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function emailVerifiedAt(int $id, int $active): bool
    {
        $this->checkRegisterRepository->checkUserIdExist($id);
        return $this->userRepositoryInterface->emailVerifiedAt($id, $active);
    }
}
