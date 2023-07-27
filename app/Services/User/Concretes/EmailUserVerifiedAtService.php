<?php

namespace App\Services\User\Concretes;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\EmailUserVerifiedAtServiceInterface;

class EmailUserVerifiedAtService implements EmailUserVerifiedAtServiceInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function emailVerifiedAt(int $id, bool $active): bool
    {
        return $this->userRepository->emailVerifiedAt($id, $active);
    }
}
