<?php

namespace App\Services\User\Concretes;

use App\Http\Requests\User\UserEditRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\EditUserServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Cases\UserCase;
use App\Support\Enums\PermissionEnum;

class EditUserService extends ValidationPermission implements EditUserServiceInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;  
    }

    public function editUser(UserEditRequest $request): bool
    {
        $this->validationPermission(PermissionEnum::EDITAR_USUARIO);
        $user = $this->map($request);
        return $this->userRepository->update($user);
    }

    private function map(UserEditRequest $request): User
    {
        $user = new User();
        $user->id = $request->id;
        $user->name = $request->nome;
        $user->email = $request->email;
        $user->genero = UserCase::genderCase($request->genero);
        return $user;
    }
}
