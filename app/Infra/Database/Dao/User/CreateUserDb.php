<?php

namespace App\Infra\Database\Dao\User;

use App\Http\Requests\User\CreateUserRequest;
use App\Infra\Database\Config\DbBase;
use App\Support\Utils\Enums\UserEnums;
use Illuminate\Support\Facades\Hash;

class CreateUserDb extends DbBase
{
    public function createUser(CreateUserRequest $request, string $genero): int
    {
        $usuarioId = $this->db
        ->table('users')
        ->insertGetId([
            'name' => $request->nome,
            'email' => $request->email,
            'ativo' => UserEnums::ATIVADO,
            'genero' => $genero,
            'password' => Hash::make($request->senha),
            'created_at' => new \DateTime()
        ]);
        return $usuarioId;
    }
}
