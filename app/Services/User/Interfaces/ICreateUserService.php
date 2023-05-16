<?php

namespace App\Services\User\Interfaces;

use App\Http\Requests\UserRequest;

interface ICreateUserService
{
    public function createUser(UserRequest $request): int;
}
