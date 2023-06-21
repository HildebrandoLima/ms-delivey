<?php

namespace App\Services\User;

use App\DataTransferObjects\RequestsDtos\UserRequestDto;
use App\Http\Requests\UserRequest;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\IEditUserService;

class EditUserService implements IEditUserService
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
        $user = UserRequestDto::fromRquest($request);
        return $this->userRepositoryInterface->update($id, $user);
    }

    private function checkExist(int $id): void
    {
        $this->checkEntityRepositoryInterface->checkUserIdExist($id);
    }
}
