<?php

namespace App\Services\User\Concretes;

use App\Http\Requests\User\EditUserRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\EditUserServiceInterface;
use App\Support\Cases\UserCase;
use App\Support\Enums\UserEnum;

class EditUserService implements EditUserServiceInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;  
    }

    public function editUser(EditUserRequest $request): bool
    {
        $user = $this->map($request);
        return $this->userRepository->update($user);
    }

    private function map(EditUserRequest $request): User
    {
        $user = new User();
        $user->id = $request->id;
        $user->name = $request->nome;
        $user->email = $request->email;
        $user->genero = UserCase::genderCase($request->genero);
        $user->ativo = $request->ativo == true ? UserEnum::ATIVADO : UserEnum::DESATIVADO;
        return $user;
    }
}
