<?php

namespace App\Services\User\Concretes;

use App\Models\User;
use App\Repositories\Abstracts\EntityRepository;
use App\Services\User\Interfaces\EmailUserVerifiedAtServiceInterface;

class EmailUserVerifiedAtService implements EmailUserVerifiedAtServiceInterface
{
    private EntityRepository $userRepository;

    public function __construct(EntityRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function emailVerifiedAt(int $id): bool
    {
        $user = $this->map($id);
        return $this->userRepository->update($user);
    }

    private function map(int $id): User
    {
        $user = new User();
        $user->id = $id;
        $user->email_verified_at = 1;
        return $user;
    }
}
