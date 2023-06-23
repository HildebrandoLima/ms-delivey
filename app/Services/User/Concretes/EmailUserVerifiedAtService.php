<?php

namespace App\Services\User\Concretes;

use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\EmailUserVerifiedAtServiceInterface;

class EmailUserVerifiedAtService implements EmailUserVerifiedAtServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private UserRepositoryInterface        $userRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        UserRepositoryInterface        $userRepository,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->userRepository        = $userRepository;
    }

    public function emailVerifiedAt(int $id, int $active): bool
    {
        $this->checkEntityRepository->checkUserIdExist($id);
        return $this->userRepository->emailVerifiedAt($id, $active);
    }
}
