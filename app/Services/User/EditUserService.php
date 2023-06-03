<?php

namespace App\Services\User;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\UserRepository;
use App\Services\User\Interfaces\IEditUserService;
use App\Support\Utils\Cases\UserCase;
use App\Support\Utils\Enums\UserEnum;
use Illuminate\Support\Facades\Hash;

class EditUserService implements IEditUserService
{
    private UserCase $userCase;
    private CheckRegisterRepository $checkRegisterRepository;
    private UserRepository $userRepository;

    public function __construct
    (
        UserCase                $userCase,
        CheckRegisterRepository $checkRegisterRepository,
        UserRepository          $userRepository
    )
    {
        $this->userCase                = $userCase;
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->userRepository          = $userRepository;
    }

    public function editUser(int $id, UserRequest $request): bool
    {
        $this->request = $request;
        $this->checkExist($id);
        $user = $this->mapToModel();
        return $this->userRepository->update($id, $user);
    }

    public function checkExist(int $id): void
    {
        $this->checkRegisterRepository->checkUserIdExist($id);
    }

    private function mapToModel(): User
    {
        $user = new User();
        $user->name = $this->request->nome;
        $user->cpf = str_replace(array('.','-','/'), "", $this->request->cpf);
        $user->email = $this->request->email;
        $user->password = Hash::make($this->request->senha);
        $user->data_nascimento = $this->request->dataNascimento;
        $user->genero = $this->userCase->genderCase($this->request->genero);
        $this->request->ativo == 1 ? $user->ativo = UserEnum::ATIVADO : $user->ativo = UserEnum::DESATIVADO;
        return $user;
    }
}
