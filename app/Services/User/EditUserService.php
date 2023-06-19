<?php

namespace App\Services\User;

use App\DataTransferObjects\Create\UserDto;
use App\Http\Requests\UserRequest;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\EntityRepositoryInterface;
use App\Services\User\Interfaces\IEditUserService;

class EditUserService implements IEditUserService
{    
    private CheckRegisterRepository   $checkRegisterRepository;
    private EntityRepositoryInterface $entityRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository   $checkRegisterRepository,
        EntityRepositoryInterface $entityRepositoryInterface,
    )
    {
        $this->checkRegisterRepository   = $checkRegisterRepository;
        $this->entityRepositoryInterface = $entityRepositoryInterface;  
    }

    public function editUser(int $id, UserRequest $request): bool
    {
        $this->checkExist($id);
        $user = UserDto::fromRquest($request);
        return $this->entityRepositoryInterface->update($id, $user);
    }

    private function checkExist(int $id): void
    {
        $this->checkRegisterRepository->checkUserIdExist($id);
    }
}
