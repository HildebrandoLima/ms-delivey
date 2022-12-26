<?php

namespace App\Infra\Database\Dao\User;

use App\Http\Requests\User\UserRequest;
use App\Infra\Database\Config\DbBase;

class DeleteUserDb extends DbBase
{
    public function deleteUser(UserRequest $request): bool
    {
        return $this->db
        ->table('users')
        ->where('id', $request->usuarioId)
        ->delete();
    }
}
