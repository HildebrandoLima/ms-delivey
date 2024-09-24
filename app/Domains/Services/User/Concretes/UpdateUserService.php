<?php

namespace App\Domains\Services\User\Concretes;

use App\Data\Repositories\User\Interfaces\IUpdateUserRepository;
use App\Domains\Services\User\Interfaces\IUpdateUserService;
use App\Domains\Traits\RequestConfigurator;
use App\Http\Requests\User\UpdateUserRequest;

class UpdateUserService implements IUpdateUserService
{
    use RequestConfigurator;
    private IUpdateUserRepository $updateUserRepository;

    public function __construct(IUpdateUserRepository $updateUserRepository)
    {
        $this->updateUserRepository = $updateUserRepository;  
    }

    public function update(UpdateUserRequest $request): bool
    {
        $this->setRequest($request);
        return $this->updated();
    }

    private function updated(): bool
    {
        return $this->updateUserRepository->update($this->request);
    }
}
