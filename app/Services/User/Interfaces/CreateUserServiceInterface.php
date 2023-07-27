<?php

namespace App\Services\User\Interfaces;

use App\Http\Requests\User\CreateUserRequest;

interface CreateUserServiceInterface
{
    public function createUser(CreateUserRequest $request): int;
}
