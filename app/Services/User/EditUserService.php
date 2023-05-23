<?php

namespace App\Services\User;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\User\Interfaces\IEditUserService;
use App\Support\Utils\Cases\UserCase;
use App\Support\Utils\CheckRegister\CheckUser;
use App\Support\Utils\Enums\UserEnums;
use Illuminate\Support\Facades\Hash;

class EditUserService implements IEditUserService
{
    private CheckUser $checkUser;
    private UserCase $userCase;
    private UserRepository $userRepository;

    public function __construct
    (
        CheckUser      $checkUser,
        UserCase       $userCase,
        UserRepository $userRepository
    )
    {
        $this->checkUser      = $checkUser;
        $this->userCase       = $userCase;
        $this->userRepository = $userRepository;
    }

    public function editUser(int $id, UserRequest $request): bool
    {
        $this->request = $request;
        $this->checkUser->checkUserIdExist($id);
        $user = $this->mapToModel($request);
        return $this->userRepository->update($id, $user);
    }

    private function mapToModel(UserRequest $request): User
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
