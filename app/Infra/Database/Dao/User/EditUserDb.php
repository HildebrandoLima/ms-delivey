<?php

namespace App\Infra\Database\Dao\User;

use App\Http\Requests\User\EditUserRequest;
use App\Infra\Database\Config\DbBase;
use App\Support\Utils\Enums\UserEnums;
use Illuminate\Support\Facades\Hash;

class EditUserDb extends DbBase
{
    public function editUser(EditUserRequest $request, string $genero): bool
    {
        return $this->db
        ->table('users')
        ->where('id', $request->usuarioId)
        ->update([
            'name' => $request->nome,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'password' => Hash::make($request->senha),
            'genero' => $genero,
            'ativo' => $request->atividade === '1' ? UserEnums::ATIVADO : UserEnums::DESATIVADO,
            'updated_at' => new \DateTime()
        ]);
    }
}
