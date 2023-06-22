<?php

namespace App\Services\User\Concretes;

use App\DataTransferObjects\RequestsDtos\UserRequestDto;
use App\Http\Requests\UserRequest;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\EditUserServiceInterface;

class EditUserService implements EditUserServiceInterface
{    
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;
    private UserRepositoryInterface        $userRepositoryInterface;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepositoryInterface,
        UserRepositoryInterface        $userRepositoryInterface,
    )
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
        $this->userRepositoryInterface        = $userRepositoryInterface;  
    }

    public function editUser(int $id, UserRequest $request): bool
    {
        $this->checkExist($id);
        $user = UserRequestDto::fromRquest($request->toArray());
        $this->userRepositoryInterface->update($id, $user);
        return true;
    }

    private function checkExist(int $id): void
    {
        $this->checkEntityRepositoryInterface->checkUserIdExist($id);
    }
}
