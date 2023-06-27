<?php

namespace App\Services\User\Concretes;

use App\DataTransferObjects\RequestsDtos\UserRequestDto;
use App\Http\Requests\UserRequest;
use App\Jobs\EmailForRegisterJob;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\CreateUserServiceInterface;
use App\Support\Permissions\CreatePermissions;

class CreateUserService implements CreateUserServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private UserRepositoryInterface        $userRepository;
    private CreatePermissions              $createPermissions;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        UserRepositoryInterface        $userRepository,
        CreatePermissions              $createPermissions,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->userRepository        = $userRepository;
        $this->createPermissions     = $createPermissions;
    }

    public function createUser(UserRequest $request): int
    {
        $this->checkExist($request);
        $user = UserRequestDto::fromRquest($request->toArray());
        $createUser = $this->userRepository->create($user);
        $this->createPermissions->createPermissions($request->perfil, $createUser->id);
        if ($createUser) $this->dispatchJob($createUser->id, $request->email);
        return $createUser->id;
    }

    private function checkExist(UserRequest $request): void
    {
        $this->checkEntityRepository->checkUserExist($request);
    }

    private function dispatchJob(int $userId, string $email): void
    {
        EmailForRegisterJob::dispatch($email, $userId);
    }
}
