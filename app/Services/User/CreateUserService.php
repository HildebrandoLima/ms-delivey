<?php

namespace App\Services\User;

use App\Http\Requests\User\CreateUserRequest;
use App\Infra\Database\Dao\User\CreateUserDb;

class CreateUserService
{
    private CreateUserDb $createUserDb;

    public function __construct(CreateUserDb $createUserDb)
    {
        $this->createUserDb = $createUserDb;
    }

    public function createUser(CreateUserRequest $request): int
    {
        return $this->createUserDb->createUser($request);
    }
}
