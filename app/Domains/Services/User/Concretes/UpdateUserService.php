<?php

namespace App\Domains\Services\User\Concretes;

use App\Data\Repositories\User\Interfaces\IUpdateUserRepository;
use App\Domains\Services\User\Interfaces\IUpdateUserService;
use App\Http\Requests\User\UpdateUserRequest;

class UpdateUserService implements IUpdateUserService
{
    private IUpdateUserRepository $updateUserRepository;

    public function __construct(IUpdateUserRepository $updateUserRepository)
    {
        $this->updateUserRepository = $updateUserRepository;  
    }

    public function update(UpdateUserRequest $request): bool
    {
        return $this->updateUserRepository->update($request);
    }
}
