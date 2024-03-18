<?php

namespace App\Domains\Services\Auth\Concretes;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Data\Repositories\Abstracts\IUserRepository;
use App\Domains\Services\Auth\Abstracts\IRefreshPasswordService;
use App\Http\Requests\Auth\RefreshPasswordRequest;
use App\Models\User;

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
        $userId = $this->userRepository->readCode($request->codigo);
        $user = $this->map($userId, $request->senha);
        if ($this->authRepository->update($user) and $this->userRepository->delete($request->codigo)):
            return true;
        else:
            return false;
        endif;
    }

    private function map(int $userId, string $senha): User
    {
        $user = new User();
        $user->id = $userId;
        $user->password = $senha;
        return $user;
    }
}
