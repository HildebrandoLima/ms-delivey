<?php

namespace App\Services\User\Concretes;

use App\Http\Requests\User\EditUserRequest;
use App\Models\User;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\User\Abstracts\IEditUserService;

class EditUserService implements IEditUserService
{
    private IEntityRepository $userRepository;

    public function __construct(IEntityRepository $userRepository)
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
        return $user;
    }
}
