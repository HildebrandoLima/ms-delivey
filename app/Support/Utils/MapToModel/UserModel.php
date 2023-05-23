<?php

namespace App\Support\Utils\MapToModel;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Support\Utils\Cases\UserCase;
use App\Support\Utils\Enums\UserEnums;
use Illuminate\Support\Facades\Hash;

class UserModel {
    private UserCase $userCase;

    public function __construct(UserCase $userCase)
    {
        $this->userCase = $userCase;
    }

    public function userModel(UserRequest $request): User
    {
        $user = new User();
        $user->name = $request->nome;
        $user->cpf = $request->cpf;
        $user->email = $request->email;
        $user->password = Hash::make($request->senha);
        $user->data_nascimento = $request->dataNascimento;
        $user->genero = $this->userCase->genderCase($request->genero);
        $request->ativo == 1 ? $user->ativo = UserEnums::ATIVADO : $user->ativo = UserEnums::DESATIVADO;
        return $user;
    }
}
