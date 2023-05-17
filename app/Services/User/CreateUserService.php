<?php

namespace App\Services\User;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\User\Interfaces\ICreateUserService;
use App\Support\Utils\Cases\UserCase;
use App\Support\Utils\CheckRegister\CheckUser;
use App\Support\Utils\Enums\UserEnums;
use Illuminate\Support\Facades\Hash;
use DateTime;

class CreateUserService implements ICreateUserService
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

    public function createUser(UserRequest $request): int
    {
        $this->request = $request;
        $this->checkUser->checkUserExist($this->request);
        $user = $this->mapToModel();
        return $this->userRepository->insert($user);
    }

    private function mapToModel(): User
    {
        $user = new User();
        $user->name = $this->request->nome;
        $user->cpf = $this->request->cpf;
        $user->email = $this->request->email;
        $user->password = Hash::make($this->request->senha);
        $user->data_nascimento = $this->request->dataNascimento;
        $user->genero = $this->userCase->genderCase($this->request->genero);
        $user->ativo = UserEnums::ATIVADO;
        $user->created_at = new DateTime();
        return $user;
    }
}
