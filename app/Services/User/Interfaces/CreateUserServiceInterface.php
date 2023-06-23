<?php

namespace App\Services\User\Interfaces;

use App\Http\Requests\UserRequest;

interface CreateUserServiceInterface
{
    public function createUser(UserRequest $request): int;
}
