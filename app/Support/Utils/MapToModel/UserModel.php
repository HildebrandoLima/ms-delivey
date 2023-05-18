<?php

namespace App\Support\Utils\MapToModel;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Support\Utils\Cases\UserCase;
use App\Support\Utils\Enums\UserEnums;
use Illuminate\Support\Facades\Hash;
use DateTime;

class UserModel {
    private UserCase $userCase;

    public function __construct(UserCase $userCase)
    {
        $this->userCase = $userCase;
    }

    public function userModel(UserRequest $request, string $method): User
    {
        $user = new User();
        $user->name = $request->nome;
        $user->cpf = $request->cpf;
        $user->email = $request->email;
        $user->password = Hash::make($request->senha);
        $user->data_nascimento = $request->dataNascimento;
        $user->genero = $this->userCase->genderCase($request->genero);
        $user->ativo = UserEnums::ATIVADO;
        $method == 'create' ? $user->created_at = new DateTime() : $user->updated_at = new DateTime();
        return $user;
    }
}
