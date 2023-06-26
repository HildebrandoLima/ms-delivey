<?php

namespace App\Services\User\Concretes;

use App\DataTransferObjects\RequestsDtos\UserRequestDto;
use App\Http\Requests\UserRequest;
use App\Jobs\EmailForRegisterJob;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\CreateUserServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Enums\PermissionEnum;

class CreateUserService extends ValidationPermission implements CreateUserServiceInterface
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

    public function createUser(UserRequest $request): int
    {
        $this->validationPermission(PermissionEnum::CRIAR_USUARIO);
        $this->checkExist($request);
        $user = UserRequestDto::fromRquest($request->toArray());
        $createUser = $this->userRepository->create($user);
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
