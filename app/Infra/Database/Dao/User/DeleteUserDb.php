<?php

namespace App\Infra\Database\Dao\User;

use Illuminate\Http\Request;
use App\Infra\Database\Config\DbBase;

class DeleteUserDb extends DbBase
{
    public function deleteUser(Request $request): bool
    {
        return $this->db
            ->table('users')
            ->where('id', $request->usuarioId)
            ->delete();
    }
}
