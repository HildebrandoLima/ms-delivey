<?php

namespace App\Services\User;

use App\Http\Requests\UserRequest;
use App\Jobs\EmailForRegisterJob;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\User\Interfaces\ICreateUserService;
use App\Support\Utils\Cases\UserCase;
use App\Support\Utils\CheckRegister\CheckUser;
use App\Support\Utils\Enums\UserEnums;
use Illuminate\Support\Facades\Hash;

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
        $this->checkUser->checkUserExist($request);
        $user = $this->mapToModel($request);
        $userId = $this->userRepository->insert($user);
        EmailForRegisterJob::dispatch($request->email);
        return $userId;
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
        $user->ativo = UserEnums::ATIVADO;
        return $user;
    }
}
