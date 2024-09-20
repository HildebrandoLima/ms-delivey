<?php

namespace App\Data\Repositories\User\Interfaces;

use App\Http\Requests\User\CreateUserRequest;

interface ICreateUserRepository
{
    public function create(CreateUserRequest $request): int;
}
