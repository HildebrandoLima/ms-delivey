<?php

namespace App\Services\User\Concretes;

use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\EmailUserVerifiedAtServiceInterface;

class EmailUserVerifiedAtService implements EmailUserVerifiedAtServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;
    private UserRepositoryInterface        $userRepositoryInterface;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepositoryInterface,
        UserRepositoryInterface        $userRepositoryInterface,
    )
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
        $this->userRepositoryInterface        = $userRepositoryInterface;
    }

    public function emailVerifiedAt(int $id, int $active): bool
    {
        $this->checkEntityRepositoryInterface->checkUserIdExist($id);
        return $this->userRepositoryInterface->emailVerifiedAt($id, $active);
    }
}
