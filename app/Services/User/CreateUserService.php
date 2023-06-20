<?php

namespace App\Services\User;

use App\DataTransferObjects\RequestsDtos\UserRequestDto;
use App\Http\Requests\UserRequest;
use App\Jobs\EmailForRegisterJob;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\ICreateUserService;

class CreateUserService implements ICreateUserService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        UserRepositoryInterface $userRepositoryInterface,
    )
    {
        $this->checkRegisterRepository   = $checkRegisterRepository;
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function createUser(UserRequest $request): int
    {
        $this->checkExist($request);
        $user = UserRequestDto::fromRquest($request);
        $createUser = $this->userRepositoryInterface->create($user);
        if ($createUser) $this->dispatchJob($createUser->id, $request->email);
        return $createUser->id;
    }

    private function checkExist(UserRequest $request): void
    {
        $this->checkRegisterRepository->checkUserExist($request);
    }

    private function dispatchJob(int $userId, string $email): void
    {
        EmailForRegisterJob::dispatch($email, $userId);
    }
}
