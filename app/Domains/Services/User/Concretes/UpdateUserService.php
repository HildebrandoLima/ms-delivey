<?php

namespace App\Domains\Services\User\Concretes;

use App\Data\Repositories\User\Interfaces\IUpdateUserRepository;
use App\Domains\Services\User\Interfaces\IUpdateUserService;
use App\Http\Requests\User\UpdateUserRequest;

class UpdateUserService implements IUpdateUserService
{
    private IUpdateUserRepository $updateUserRepository;
    private UpdateUserRequest $request;

    public function __construct(IUpdateUserRepository $updateUserRepository)
    {
        $this->updateUserRepository = $updateUserRepository;  
    }

    public function update(UpdateUserRequest $request): bool
    {
        $this->setRequest($request);
        return $this->updated();
    }

    private function setRequest(UpdateUserRequest $request): void
    {
        $this->request = $request;
    }

    public function updated(): bool
    {
        return $this->updateUserRepository->update($this->request);
    }
}
