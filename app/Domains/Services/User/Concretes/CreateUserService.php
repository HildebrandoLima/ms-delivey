<?php

namespace App\Domains\Services\User\Concretes;

use App\Data\Repositories\User\Interfaces\ICreateUserRepository;
use App\Domains\Services\User\Abstracts\ICreateUserService;
use App\Http\Requests\User\CreateUserRequest;
use App\Jobs\EmailForRegisterJob;

class CreateUserService implements ICreateUserService
{
    private ICreateUserRepository $createUserRepository;

    public function __construct(ICreateUserRepository $createUserRepository)
    {
        $this->createUserRepository = $createUserRepository;
    }

    public function createUser(CreateUserRequest $request): int
    {
        $userId = $this->createUserRepository->create($request);
        if ($userId) $this->dispatchJob($request->email, $userId);
        return $userId;
    }

    private function dispatchJob(string $email, int $userId): void
    {
        EmailForRegisterJob::dispatch($email, $userId);
    }
}
