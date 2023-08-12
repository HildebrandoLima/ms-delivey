<?php

namespace App\Services\User\Abstracts;

use App\Http\Requests\User\CreateUserRequest;

interface ICreateUserService
{
    public function createUser(CreateUserRequest $request): int;
}
