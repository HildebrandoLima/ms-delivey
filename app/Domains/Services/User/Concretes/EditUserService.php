<?php

namespace App\Domains\Services\User\Concretes;

use App\Data\Repositories\User\Interfaces\IUpdateUserRepository;
use App\Domains\Services\User\Abstracts\IEditUserService;
use App\Http\Requests\User\EditUserRequest;

class EditUserService implements IEditUserService
{
    private IUpdateUserRepository $updateUserRepository;

    public function __construct(IUpdateUserRepository $updateUserRepository)
    {
        $this->updateUserRepository = $updateUserRepository;  
    }

    public function editUser(EditUserRequest $request): bool
    {
        return $this->updateUserRepository->update($request);
    }
}
