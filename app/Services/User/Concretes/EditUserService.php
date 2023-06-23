<?php

namespace App\Services\User\Concretes;

use App\DataTransferObjects\RequestsDtos\UserRequestDto;
use App\Http\Requests\UserRequest;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\EditUserServiceInterface;

class EditUserService implements EditUserServiceInterface
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

    public function editUser(int $id, UserRequest $request): bool
    {
        $this->checkExist($id);
        $user = UserRequestDto::fromRquest($request->toArray());
        $this->userRepository->update($id, $user);
        return true;
    }

    private function checkExist(int $id): void
    {
        $this->checkEntityRepository->checkUserIdExist($id);
    }
}
