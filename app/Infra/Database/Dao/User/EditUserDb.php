<?php

namespace App\Infra\Database\Dao\User;

use App\Http\Requests\User\EditUserRequest;
use App\Infra\Database\Config\DbBase;
use App\Support\Utils\Enums\UserEnums;
use Illuminate\Support\Facades\Hash;

class EditUserDb extends DbBase
{
    public function editUser(EditUserRequest $request): bool
    {
        return $this->db
        ->table('users')
        ->where('id', $request->usuarioId)
        ->update([
            'name' => $request->nome,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'password' => Hash::make($request->senha),
            'data_nascimento' => $request->dataNascimento,
            'ativo' => $request->atividade === '1' ? UserEnums::ATIVADO : UserEnums::DESATIVADO,
            'genero' => ($request->genero == 'Masculino') ? UserEnums::GENERO_MASCULINO : (($request->genero == 'Feminino') ? UserEnums::GENERO_FEMININO : UserEnums::GENERO_OUTRO),
            'updated_at' => new \DateTime()
        ]);
    }
}
