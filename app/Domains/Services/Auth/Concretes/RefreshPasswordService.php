<?php

namespace App\Domains\Services\Auth\Concretes;

use App\Data\Repositories\Abstracts\IAuthRepository;
use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Auth\Abstracts\IRefreshPasswordService;
use App\Http\Requests\Auth\RefreshPasswordRequest;
use App\Models\User;

class RefreshPasswordService implements IRefreshPasswordService
{
    private IAuthRepository   $authRepository;
    private IEntityRepository $entityRepository;

    public function __construct
    (
        IAuthRepository   $authRepository,
        IEntityRepository $entityRepository
    )
    {
        $this->authRepository = $authRepository;
        $this->entityRepository = $entityRepository;
    }

    public function refreshPassword(RefreshPasswordRequest $request): bool
    {
        $userId = $this->authRepository->readCode($request->codigo);
        $user = $this->map($userId, $request->senha);
        if ($this->entityRepository->update($user) and $this->authRepository->delete($request->codigo)):
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
