<?php

namespace App\Services\User;

use App\DataTransferObjects\RequestsDtos\UserRequestDto;
use App\Http\Requests\UserRequest;
use App\Jobs\EmailForRegisterJob;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\ICreateUserService;

class CreateUserService implements ICreateUserService
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

    public function createUser(UserRequest $request): int
    {
        $this->checkExist($request);
        $user = UserRequestDto::fromRquest($request->toArray());
        $createUser = $this->userRepositoryInterface->create($user);
        if ($createUser) $this->dispatchJob($createUser->id, $request->email);
        return $createUser->id;
    }

    private function checkExist(UserRequest $request): void
    {
        $this->checkEntityRepositoryInterface->checkUserExist($request);
    }

    private function dispatchJob(int $userId, string $email): void
    {
        EmailForRegisterJob::dispatch($email, $userId);
    }
}
