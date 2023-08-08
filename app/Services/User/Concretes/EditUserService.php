<?php

namespace App\Services\User\Concretes;

use App\Http\Requests\User\EditUserRequest;
use App\Models\User;
use App\Repositories\Abstracts\EntityRepository;
use App\Services\User\Interfaces\EditUserServiceInterface;
use App\Support\Enums\AtivoEnum;

class EditUserService implements EditUserServiceInterface
{
    private EntityRepository $userRepository;

    public function __construct(EntityRepository $userRepository)
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
        $user->nome = $request->nome;
        $user->email = $request->email;
        $user->genero = $request->genero;
        $user->ativo = $request->ativo == true ? AtivoEnum::ATIVADO : AtivoEnum::DESATIVADO;
        return $user;
    }
}
