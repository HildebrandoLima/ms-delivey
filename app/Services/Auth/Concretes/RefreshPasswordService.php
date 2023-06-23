<?php

namespace App\Services\Auth\Concretes;

use App\Http\Requests\RefreshPasswordRequest;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Auth\Interfaces\RefreshPasswordServiceInterface;

class RefreshPasswordService implements RefreshPasswordServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private AuthRepositoryInterface        $authRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        AuthRepositoryInterface        $authRepository,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->authRepository        = $authRepository;
    }

    public function refreshPassword(RefreshPasswordRequest $request, string $token): bool
    {
        $this->checkEntityRepository->checkTokenPassword($token);
        $this->checkEntityRepository->checkUserCodeRefreshPassword($request->codigo);
        return $this->authRepository->refreshPassword($request);
    }
}
