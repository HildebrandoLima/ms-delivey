<?php

namespace App\Services\Auth\Concretes;

use App\Http\Requests\Auth\RefreshPasswordRequest;
use App\Models\User;
use App\Repositories\Abstracts\IEntityRepository;
use App\Repositories\Abstracts\IUserRepository;
use App\Services\Auth\Abstracts\IRefreshPasswordService;

class RefreshPasswordService implements IRefreshPasswordService
{
    private IEntityRepository $authRepository;
    private IUserRepository   $userRepository;

    public function __construct
    (
        IEntityRepository $authRepository,
        IUserRepository   $userRepository
    )
    {
        $this->authRepository = $authRepository;
        $this->userRepository = $userRepository;
    }

    public function refreshPassword(RefreshPasswordRequest $request): bool
    {
        $user = $this->map($request);
        if ($this->authRepository->update($user) and $this->userRepository->delete($request->codigo)):
            return true;
        else:
            return false;
        endif;
    }

    private function map(RefreshPasswordRequest $request): User
    {
        $user = new User();
        $user->id = $this->userRepository->readCode($request->codigo);
        $user->password = $request->senha;
        return $user;
    }
}
