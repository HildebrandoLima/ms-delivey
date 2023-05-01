<?php

namespace App\Infra\Database\Dao\User;

use App\Http\Requests\UserRequest;
use App\Infra\Database\Config\DbBase;
use App\Support\Utils\Enums\UserEnums;
use Illuminate\Support\Facades\Hash;

class CreateUserDb extends DbBase
{
    public function createUser(UserRequest $request): int
    {
        $usuarioId = $this->db
        ->table('users')
        ->insertGetId([
            'name' => $request->nome,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'password' => Hash::make($request->senha),
            'data_nascimento' => $request->dataNascimento,
            'ativo' => UserEnums::ATIVADO,
            'genero' => ($request->genero == 'Masculino') ? UserEnums::GENERO_MASCULINO : (($request->genero == 'Feminino') ? UserEnums::GENERO_FEMININO : UserEnums::GENERO_OUTRO),
            'created_at' => new \DateTime(),
        ]);
        return $usuarioId;
    }
}
