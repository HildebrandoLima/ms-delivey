<?php

namespace App\Infra\Database\Dao\User;

use App\Http\Requests\User\EditUserRequest;
use App\Infra\Database\Config\DbBase;
use Illuminate\Support\Facades\Hash;

class EditUserDb extends DbBase
{
    public function editUser(EditUserRequest $request, string $atividade, string $genero): bool
    {
        return $this->db
        ->table('users')
        ->where('id', $request->usuarioId)
        ->update([
            'name' => $request->nome,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'ativo' => $atividade,
            'genero' => $genero,
            'password' => Hash::make($request->senha),
            'updated_at' => new \DateTime()
        ]);
    }
}
