<?php

namespace App\Services\User;

use App\Http\Requests\User\EditUserRequest;
use App\Infra\Database\Dao\User\EditUserDb;

class EditUserService
{
    private EditUserDb   $editUserDb;

    public function __construct(EditUserDb $editUserDb)
    {
        $this->editUserDb = $editUserDb;
    }

    public function editUser(EditUserRequest $request): bool
    {
        return $this->editUserDb->editUser($request);
    }
}
