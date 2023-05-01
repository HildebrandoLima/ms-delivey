<?php

namespace App\Services\User;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Support\Utils\Cases\UserCase;
use App\Support\Utils\Enums\UserEnums;
use DateTime;

class EditUserService
{
    private UserRepository $userRepository;
    private UserCase $userCase;

    public function __construct(UserRepository $userRepository, UserCase $userCase)
    {
        $this->userRepository = $userRepository;
        $this->userCase = $userCase;
    }

    public function editUser(int $id, UserRequest $request): bool
    {
        $this->request = $request;
        $user = $this->mapToModel();
        return $this->userRepository->update($id, $user);
    }

    private function mapToModel(): User
    {
        $user = new User();
        $user->name = $this->request->nome;
        $user->cpf = $this->request->cpf;
        $user->email = $this->request->email;
        $user->password = $this->request->senha;
        $user->data_nascimento = $this->request->dataNascimento;
        $user->genero = $this->userCase->genderCase($this->request->genero);
        $user->ativo = UserEnums::ATIVADO;
        $user->updated_at = new DateTime();
        return $user;
    }
}
