<?php

namespace App\Services\User\Concretes;

use App\Http\Requests\UserEditRequest;
use App\Models\User;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\EditUserServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Cases\UserCase;
use App\Support\Enums\PermissionEnum;

class EditUserService extends ValidationPermission implements EditUserServiceInterface
{    
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private UserRepositoryInterface        $userRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        UserRepositoryInterface        $userRepository,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->userRepository        = $userRepository;  
    }

    public function editUser(int $id, UserEditRequest $request): bool
    {
        $this->validationPermission(PermissionEnum::EDITAR_USUARIO);
        $this->checkExist($id);
        $user = $this->map($request);
        return $this->userRepository->update($id, $user);
    }

    private function checkExist(int $id): void
    {
        $this->checkEntityRepository->checkUserIdExist($id);
    }

    private function map(UserEditRequest $request): User
    {
        $user = new User();
        $user->name = $request->nome;
        $user->email = $request->email;
        $user->genero = UserCase::genderCase($request->genero);
        return $user;
    }
}
