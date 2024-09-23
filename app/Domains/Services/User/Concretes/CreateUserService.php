<?php

namespace App\Domains\Services\User\Concretes;

use App\Data\Repositories\User\Interfaces\ICreateUserRepository;
use App\Domains\Services\User\Interfaces\ICreateUserService;
use App\Domains\Traits\RequestConfigurator;
use App\Http\Requests\User\CreateUserRequest;
use App\Jobs\EmailForRegisterJob;

class CreateUserService implements ICreateUserService
{
    use RequestConfigurator;
    private ICreateUserRepository $createUserRepository;
    private int $userId = 0;

    public function __construct(ICreateUserRepository $createUserRepository)
    {
        $this->createUserRepository = $createUserRepository;
    }

    public function create(CreateUserRequest $request): int
    {
        $this->setRequest($request);
        $this->created();
        $this->check();
        return $this->userId;
    }

    public function created(): void
    {
        $this->userId = $this->createUserRepository->create($this->request);
    }

    public function check(): void
    {
        if ($this->userId) $this->dispatchJob();
    }

    private function dispatchJob(): void
    {
        EmailForRegisterJob::dispatch($this->request->email, $this->userId);
    }
}
