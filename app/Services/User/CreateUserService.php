<?php

namespace App\Services\User;

use App\Exceptions\HttpBadRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\User\Interfaces\ICreateUserService;
use App\Support\Utils\Cases\UserCase;
use App\Support\Utils\Enums\UserEnums;
use Illuminate\Support\Facades\Hash;
use DateTime;

class CreateUserService implements ICreateUserService
{
    private UserRepository $userRepository;
    private UserCase $userCase;

    public function __construct(UserRepository $userRepository, UserCase $userCase)
    {
        $this->userRepository = $userRepository;
        $this->userCase = $userCase;
    }

    public function createUser(UserRequest $request): int
    {
        $this->request = $request;
        $this->checkUser();
        $user = $this->mapToModel();
        return $this->userRepository->insert($user);
    }

    private function checkUser(): void
    {
        if (!User::query()
                ->where('name', 'like', $this->request->nome)
                ->orWhere(function ($query) {
                    $query->where('cpf', '=', $this->request->cpf)
                        ->orWhere(function ($query) {
                            $query->where('email', 'like', $this->request->email);
                        });
                })
                ->count() == 0):
            throw new HttpBadRequest('O usuário já existe');
        endif;
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
