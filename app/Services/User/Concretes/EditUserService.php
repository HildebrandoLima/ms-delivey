<?php

namespace App\Services\User\Concretes;

use App\DataTransferObjects\RequestsDtos\UserEditRequestDto;
use App\Http\Requests\UserEditRequest;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\EditUserServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Enums\PermissionEnum;

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
        $user = UserEditRequestDto::fromRquest($request->toArray());
        $this->userRepository->update($id, $user);
        return true;
    }

    private function checkExist(int $id): void
    {
        $this->checkEntityRepository->checkUserIdExist($id);
    }
}
