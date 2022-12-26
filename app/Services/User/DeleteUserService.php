<?php

namespace App\Services\User;

use App\Http\Requests\User\UserRequest;
use App\Infra\Database\Dao\User\DeleteUserDb;

class DeleteUserService
{
    private DeleteUserDb $deleteUserDb;

    public function __construct(DeleteUserDb $deleteUserDb)
    {
        $this->deleteUserDb = $deleteUserDb;
    }

    public function deleteUser(UserRequest $request): bool
    {
        return $this->deleteUserDb->deleteUser($request);
    }
}
