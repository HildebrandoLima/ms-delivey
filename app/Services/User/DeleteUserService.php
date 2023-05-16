<?php

namespace App\Services\User;

use App\Exceptions\HttpBadRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\User\Interfaces\IDeleteUserService;

class DeleteUserService implements IDeleteUserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function deleteUser(int $id): bool
    {
        $this->checkUser($id);
        $this->userRepository->delete($id);
        return true;
    }

    private function checkUser(int $id): void
    {
        if (User::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('O usuário não existe');
        endif;
    }
}
