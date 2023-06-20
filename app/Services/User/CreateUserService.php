<?php

namespace App\Services\User;

use App\DataTransferObjects\RequestsDtos\UserRequestDto;
use App\Http\Requests\UserRequest;
use App\Jobs\EmailForRegisterJob;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\EntityRepositoryInterface;
use App\Services\User\Interfaces\ICreateUserService;

class CreateUserService implements ICreateUserService
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

    public function createUser(UserRequest $request): int
    {
        $this->checkExist($request);
        $user = UserRequestDto::fromRquest($request);
        $createUser = $this->entityRepositoryInterface->create($user);
        if ($createUser) $this->dispatchJob($createUser->id, $request->email);
        return $createUser->id;
    }

    private function checkExist(UserRequest $request): void
    {
        $this->checkRegisterRepository->checkUserExist($request);
    }

    private function dispatchJob(int $userId, string $email): void
    {
        $entity = 'user';
        EmailForRegisterJob::dispatch($email, $userId, $entity);
    }
}
