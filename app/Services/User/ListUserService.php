<?php

namespace App\Services\User;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ListUserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function listUserAll(Request $request, string $search): Collection
    {
        return $this->userRepository->getAll($request, $search);
    }

    public function listUserFind(int $id): Collection
    {
        return $this->userRepository->getFind($id);
    }
}
